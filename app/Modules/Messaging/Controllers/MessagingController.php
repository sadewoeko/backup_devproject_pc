<?php

namespace App\Modules\Messaging\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Lib\core\path_config as config;
use DB;
use App\Mail\ChatNotification;
use Illuminate\Support\Facades\Mail;
use App\User;

class MessagingController extends Controller 
{
    public $controller_name = 'Messaging';
    
    public function index() 
    {

        if(empty(session('full_name'))) {
            return redirect()->route('index');
        } else {

            $content['title'] = "Messages";
            $conn = DB::connection('mysql');
            $sql = "
            SELECT 
                *, m.catalogue_id as idm, m.sender_id as sender, receiver_id as receiver
            FROM 
            messages m
            JOIN users ON users.id = IF(m.sender_id = " . session('id') . ", m.receiver_id, m.sender_id)
            JOIN users sender ON sender.id = IF(m.sender_id != " . session('id') . ", m.sender_id, m.receiver_id)
            JOIN catalogues c ON c.id = m.catalogue_id
            WHERE 
            m.id IN ( 
                SELECT 
                MAX(id) 
                FROM 
                    (SELECT 
                        IF(m.sender_id = " . session('id') . ", m.receiver_id, m.sender_id) as other_user_id, 
                        m.id,
                        m.subject
                    FROM 
                    messages m 
                    WHERE 
                    m.receiver_id = " . session('id') . " or m.sender_id = " . session('id') . ") me 
                GROUP BY subject,
                other_user_id 
            ) 
            ORDER BY 
            m.id DESC
            ";
        
            $execute = $conn->select($sql);
            $result = $execute;

            $content['datas'] = $result;
            
            return view($this->controller_name .'::index', $content);

        }
        
    }

    public function detail($sender_id, $receiver_id, $product_id = null) 
    {
        
        if(empty(session('full_name'))) {
            return redirect()->route('index');
        } else {
            $conn = DB::connection('mysql');

            $sql = "SELECT id as product_id, product_name FROM catalogues WHERE id = '" . $product_id . "'";
            $getSubject = $conn->select($sql);
            $subject = $getSubject[0]->product_name;
            $product_id = $getSubject[0]->product_id;
            

            $sql = "SELECT m.subject, m.message, m.baca, m.created_at, u.full_name, m.sender_id FROM messages m
                    JOIN users u ON u.id = IF(m.sender_id = " . session('id') . ", m.receiver_id, m.sender_id)
                    WHERE catalogue_id = '" .$product_id. "' and ((receiver_id = " . $receiver_id . " and sender_id = " . $sender_id . ") OR 
                    (sender_id = " . $receiver_id . " and receiver_id = " . $sender_id . "))";
            $execute = $conn->select($sql);
            $result = $execute;

            if($receiver_id != session('id')) {
                $sql = "SELECT id, full_name FROM users where id = " . $receiver_id;
            } else {
                $sql = "SELECT id, full_name FROM users where id = " . $sender_id;
            }
            $result_sender = $conn->select($sql);
            $sender = $result_sender[0]->full_name;
            $profile_id = $result_sender[0]->id;
            
            if (!empty($result)) {
                $last_sender = $result[max(array_keys($result))]->sender_id;            
                if ($last_sender != session('id')) {
                    $sql = "UPDATE messages SET baca = '1' WHERE (receiver_id = " . session('id') . " and sender_id = " . $sender_id . ") OR 
                    (sender_id = " . session('id') . " and receiver_id = " . $sender_id . ") and subject = '" . $subject . "'";
                    $execute = $conn->update($sql);
                }
            }
            
            return view($this->controller_name .'::detail', compact('result', 'sender', 'sender_id', 'subject', 'product_id', 'receiver_id', 'profile_id'));

        }
    }

    public function send(Request $request) 
    {
        if(empty(session('full_name'))) {
            return redirect()->route('index');
        } else {          
            $now = date("Y-m-d H:i:s");
            $sender_id = $request->input('sender_id');
            $receiver_id = $request->input('receiver_id');
    
            DB::table('messages')->insert(
                [
                    'sender_id' => $sender_id, 
                    'receiver_id' => $receiver_id,
                    'message' => $request->input('message'),
                    'baca' => 0,
                    'subject' => $request->input('subject'),
                    'catalogue_id' => $request->input('product_id'),
                    'created_at' => $now,
                    'updated_at' => $now,
                ]
            );

            $sender = $this->getSenderName(session('id'));
            $receiver = $this->getReceiver($receiver_id);      
            Mail::to($receiver->email)->send(new ChatNotification($sender, $receiver->full_name, $request->input('message'), $request->input('subject')));         
 ;
            return redirect()->route('messaging.detail', [$sender_id, $receiver_id, $request->input('product_id')]);

        }
    }

    // public function show()
    // {
    //     return view('messaging.show');
    // }

    private function getSenderName($sender_id)
    {
        $sender = User::findOrFail($sender_id);
        return $sender->full_name;
    }

    private function getReceiver($receiver_id)
    {
        $receiver = User::findOrFail($receiver_id);
        return $receiver;
    }

    public function delete_message($catalogue_id)
    {
        $conn = DB::connection('mysql');
        $sql = "DELETE FROM messages WHERE catalogue_id = ".$catalogue_id."";
        $execute = $conn->delete($sql);
        return redirect()->route('messaging.index');
    }

}
