<div style="margin-bottom: 20px;"></div>
<div class="sidebar" >
    <div class="widget">
        <h2 class="widget-title" style=" padding: 0; margin: 0; margin-bottom: 15px;">Categories</h2>
        <div class="link-widget">
            <ul style="padding: 0; margin: 0;">
                @foreach($cats as $cat)
                    <li><a href="{{ route('categories.single', ['slug' => $cat->slug]) }}">{{ $cat->title }} <span>({{ $cat->posts_count }})</span></a></li>
                @endforeach
            </ul>
        </div><!-- end link-widget -->
    </div><!-- end widget -->
</div><!-- end sidebar -->
