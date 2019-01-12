<div class="col-md-4 clearfix">
    <aside class="sidebar left-sidebar pull-left">
        <h3 class="widget-title">Filter By</h3>
        <div class="widget widget_search_by_categories">
        <div class="heading">
            <h3 class="heading-title">Categories</h3>
            <div class="widget-details">
            <ul class="category-menu">

                @foreach($categories as $category)
                    <li class="menu-item">
                        <a href="#">{{ $category->category }}</a>
                    </li>
                @endforeach

            </ul>
            </div>
        </div>
        </div>           
    </aside>
</div>