<x-frontend.web-layout>
    <section class="page_banner">
        <div class="container">
            <div class="content_wrapper" style="background-image:url(collab/assets/images/banner/page_banner_image.png)">
                <div class="row align-items-center">
                    <div class="col col-lg-6">
                        <ul class="breadcrumb_nav unordered_list">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="#!">Blogs</a></li>
                            <li>Our Blogs</li>
                        </ul>
                        <h1 class="page_title">Articles</h1>
                        <p class="page_description">Egestas sed tempus urna et pharetra. Leo integer malesuada
                            nunc vel. Libero id faucibus nisl tincidunt eget nullam non nisi. Faucibus turpis in
                            eu mi bibendum neque egestas</p>
                        <form action="#">
                            <div class="form_item mb-0"><input type="search" name="search"
                                    placeholder="What do you want to learn ?"> <button type="submit"
                                    class="btn btn_dark"><span><small>Search</small>
                                        <small>Search</small></span></button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="blog_section section_space_lg">
        <div class="container">
            <div class="row">
                <div class="col col-lg-8">
                    <div class="row">
                        @forelse ($posts as $post)
                            <div class="col col-lg-6">
                                <div class="blog_item">
                                    <ul class="item_category_list unordered_list">
                                        <li><a href="#!">{{ $post->category->name }}</a></li>
                                    </ul>
                                    <div class="item_image">
                                        <a href="{{ route('frontend.post.details', $post->id) }}"
                                            data-cursor-text="View">
                                            @if ($post->images->first())
                                                <img src="{{ $post->images->first()->file_path }}"
                                            @else
                                                <img src="{{ asset('collab/assets/images/blog/blog_small_img_3.jpg') }}"
                                                    alt="Collab – Online Learning Platform">
                                            @endif
                                        </a>
                                    </div>
                                    <div class="item_content">
                                        <ul class="meta_info_list unordered_list">
                                            <li><a href="#!"><i class="fas fa-user"></i>
                                                    <span>{{ $post->user->name }}</span></a>
                                            </li>
                                            <li><a href="#!"><i class="fas fa-calendar-day"></i>
                                                    <span>{{ $post->published_at }}</span></a></li>
                                        </ul>
                                        <h3 class="item_title"><a href="blog_details.html">{{ $post->title }}</a></h3>
                                        <ul class="meta_info_list unordered_list">
                                            @forelse ($post->tags as $tag)
                                                <li>
                                                    <a href="#!"><i class="fas fa-thumbtack"></i> <span>
                                                            {{ $tag->name }}</span></a>
                                                </li>
                                            @empty
                                                <li>
                                                    <a href="#!"><i class="fas fa-thumbtack"></i> <span>
                                                            No tags</span></a>
                                                </li>
                                            @endforelse
                                        </ul>
                                        <a class="btn_unfill" href="blog_details.html">
                                            <span class="btn_text">
                                                Leer post</span>
                                            <span class="btn_icon"><i class="fas fa-long-arrow-right"></i>
                                                <i class="fas fa-long-arrow-right"></i></span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        @empty
                        @endforelse



                    </div>
                    {{ $posts->links('vendor.pagination.blog-paginate') }}
                </div>
                <div class="col col-lg-4">
                    <aside class="sidebar ps-lg-4">
                        <div class="widget">
                            <div class="widget_title" role="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_category" aria-expanded="true"
                                aria-controls="collapse_category">Category</div>
                            <div class="collapse show" id="collapse_category">
                                <div class="card card-body">
                                    @forelse ($categories as $category)
                                        <div class="checkbox_item"><input id="checkbox_design" type="checkbox">
                                            <label
                                                for="checkbox_design"><span>{{ $category->name }}</span><span>({{ $category->posts->where('status', 'published')->count() }})</span></label>
                                        </div>
                                    @empty
                                        <div class="checkbox_item"><input id="checkbox_design" type="checkbox">
                                            <label for="checkbox_design"><span>No categories</span><span>(0)</span></label>
                                        </div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="widget_title" role="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_blog" aria-expanded="true" aria-controls="collapse_blog">
                                Related Articles</div>
                            <div class="collapse show" id="collapse_blog">
                                <div class="card card-body">
                                    <ul class="blog_small_group unordered_list_block">
                                        <li><a class="blog_small" href="blog_details.html"><span class="item_image"><img
                                                        src="collab/assets/images/blog/blog_small_img_3.jpg"
                                                        alt="Collab – Online Learning Platform"> </span><span
                                                    class="item_content"><span class="item_author"><i
                                                            class="fas fa-user-alt"></i> by Corabelle
                                                        Durrad</span> <strong class="item_title">See How
                                                        Michaele Built a New Life and Career </strong><small
                                                        class="item_post_date">October 12,
                                                        2023</small></span></a></li>
                                        <li><a class="blog_small" href="blog_details.html"><span class="item_image"><img
                                                        src="collab/assets/images/blog/blog_small_img_4.jpg"
                                                        alt="Collab – Online Learning Platform"> </span><span
                                                    class="item_content"><span class="item_author"><i
                                                            class="fas fa-user-alt"></i> by Corabelle
                                                        Durrad</span> <strong class="item_title">Driving Skills
                                                        Development for a 2030 Workforce</strong> <small
                                                        class="item_post_date">October 12,
                                                        2023</small></span></a></li>
                                        <li><a class="blog_small" href="blog_details.html"><span
                                                    class="item_image"><img
                                                        src="collab/assets/images/blog/blog_small_img_5.jpg"
                                                        alt="Collab – Online Learning Platform"> </span><span
                                                    class="item_content"><span class="item_author"><i
                                                            class="fas fa-user-alt"></i> by Corabelle
                                                        Durrad</span> <strong class="item_title">New Skills, New
                                                        Career: How Asmita to Pursue a New Role</strong> <small
                                                        class="item_post_date">October 12,
                                                        2023</small></span></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="widget_title" role="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_recent_comments" aria-expanded="true"
                                aria-controls="collapse_recent_comments">Recent Comments</div>
                            <div class="collapse show" id="collapse_recent_comments">
                                <div class="card card-body">
                                    <ul class="recent_comments_list unordered_list_block">
                                        <li><a href="#!"><i class="fas fa-comments"></i> <strong>Irene
                                                    Flores</strong> </a><span>felis eget velit aliquet sagittis
                                                id consectetur</span></li>
                                        <li><a href="#!"><i class="fas fa-comments"></i> <strong>Anthony
                                                    Patterson</strong> </a><span>gravida in fermentum et
                                                sollicitudin</span></li>
                                        <li><a href="#!"><i class="fas fa-comments"></i> <strong>Wendy
                                                    Johnson</strong> </a><span>aenean sed adipiscing diam
                                                donec</span></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="widget_title" role="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_tags_list" aria-expanded="true"
                                aria-controls="collapse_tags_list">Tags</div>
                            <div class="collapse show" id="collapse_tags_list">
                                <div class="card card-body">
                                    <ul class="tags_list style_2 unordered_list">
                                        @forelse ($tags as $tag)
                                            <li><a href="#!">{{ $tag->name }}</a></li>
                                        @empty
                                            <li><a href="#!">No tags</a></li>
                                        @endforelse
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="widget_title" role="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_archives_month" aria-expanded="true"
                                aria-controls="collapse_archives_month">Archives</div>
                            <div class="collapse show" id="collapse_archives_month">
                                <div class="card card-body">
                                    <ul class="info_list unordered_list_block">
                                        <li><a href="#!"><i class="fas fa-square"></i>
                                                <span>December</span></a>
                                        </li>
                                        <li><a href="#!"><i class="fas fa-square"></i>
                                                <span>January</span></a>
                                        </li>
                                        <li><a href="#!"><i class="fas fa-square"></i>
                                                <span>February</span></a>
                                        </li>
                                        <li><a href="#!"><i class="fas fa-square"></i> <span>March</span></a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="widget">
                            <div class="widget_title" role="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_calendar" aria-expanded="true"
                                aria-controls="collapse_calendar">Calendar</div>
                            <div class="collapse show" id="collapse_calendar">
                                <div class="card card-body">
                                    <div class="vanilla-calendar"></div>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </section>
    <section class="newslatter_section">
        <div class="container">
            <div class="newslatter_box" style="background-image:url(collab/assets/images/shape/shape_img_6.svg)">
                <div class="row justify-content-center">
                    <div class="col col-lg-6">
                        <div class="section_heading text-center">
                            <h2 class="heading_text">Subscribe Now Forget 20% Discount Every Courses</h2>
                            <p class="heading_description mb-0">Nam ipsum risus, rutrum vitae, vestibulum eu,
                                molestie vel, lacus. Sed magna purus, fermentum eu</p>
                        </div>
                        <form action="#">
                            <div class="form_item m-0"><input type="email" name="email"
                                    placeholder="Your Email"> <button type="submit"
                                    class="btn btn_dark"><span><small>Subsctibe</small>
                                        <small>Subsctibe</small></span></button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-frontend.web-layout>
