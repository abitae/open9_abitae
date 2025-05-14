<x-frontend.web-layout>
    <section class="page_banner">
        <div class="container">
            <div class="content_wrapper">
                <div class="row align-items-center">
                    <div class="col col-lg-12">
                        <ul class="breadcrumb_nav unordered_list">
                            <li><a href="{{ route('frontend.index') }}">Home</a></li>
                            <li><a href="{{ route('frontend.blog') }}">Blogs</a></li>
                            <li>{{ $post->title }}</li>
                        </ul>
                        <h1 class="page_title mb-0">{{ $post->title }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="details_section blog_details_section section_space_lg pb-0">
        <div class="container">
            <div class="row">
                <div class="col col-lg-8">
                    <div class="details_image">
                        @if ($post->image_path)
                            <img src="{{ Storage::url($post->image_path) }}" alt="image"
                                style="width: 100%; height: auto;">
                        @else
                            <img src="{{ asset('collab/assets/images/blog/blog_details_image_1.jpg') }}" alt="image"
                                style="width: 100%; height: auto;">
                        @endif
                        @if ($post->video_path)
                            <div class="video-container">
                                <video id="player" playsinline controls preload="metadata"
                                    class="video-js vjs-default-skin vjs-big-play-centered">
                                    <source src="{{ Storage::url($post->video_path) }}" type="video/mp4" />
                                    <source src="{{ Storage::url($post->video_path) }}" type="video/webm" />
                                    <source src="{{ Storage::url($post->video_path) }}" type="video/ogg" />
                                    <p class="vjs-no-js">
                                        Para ver este video, por favor habilita JavaScript y considera actualizar a un
                                        navegador web que
                                        <a href="https://videojs.com/html5-video-support/" target="_blank">soporte video
                                            HTML5</a>
                                    </p>
                                </video>
                            </div>
                        @endif
                    </div>
                    <div class="details_content">
                        <ul class="meta_info_list unordered_list">
                            <li>
                                @foreach ($post->tags as $tag)
                                    <a href="#!">
                                        <i class="fas fa-thumbtack"></i> <span>{{ $tag->name }}</span>
                                    </a>
                                @endforeach
                            </li>

                            <li><a href="#!"><i class="fas fa-user"></i> <span>{{ $post->user->name }}</span></a>
                            </li>
                            <li><a href="#!"><i class="fas fa-calendar-day"></i>
                                    <span>{{ $post->created_at->format('d M, Y') }}</span></a>
                            </li>
                        </ul>
                        <div class="text-justify">
                            {!! $post->content !!}
                        </div>
                        <div class="row">
                            <div class="col col-lg-6">
                                <ul class="item_category_list unordered_list">
                                    <li><a href="#!">{{ $post->category->name }}</a></li>
                                </ul>
                            </div>
                            <div class="col col-lg-6 d-lg-flex justify-content-lg-end">
                                <ul class="social_links unordered_list">
                                    <li><a href="#!"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#!"><i class="fab fa-youtube"></i></a></li>
                                    <li><a href="#!"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#!"><i class="fab fa-linkedin-in"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="blog_author">
                            <div class="blog_author_image"><img src="collab/assets/images/blog/blog_author_image.jpg"
                                    alt="Collab – Online Learning Platform"></div>
                            <div class="blog_author_content position-relative">
                                <h3 class="author_name">Wendy Chandler</h3>
                                <h4 class="author_designation">Collab Menthor</h4>
                                <p class="mb-0">Vel pretium lectus quam id leo in vitae turpis. Condimentum id
                                    venenatis a condimentum vitae sapien pellentesque habitant morbi. Urna nec
                                    tincidunt praesent semper feugiat nibh sed pulvinar</p><a
                                    class="btn border_dark blog_author_link"
                                    href="mentor_details.html"><span><small>Profile</small>
                                        <small>Profile</small></span></a>
                            </div>
                        </div>
                        <div class="prevnext_post_wrap"><a class="post_item" href="#!"><span><i
                                        class="far fa-arrow-left"></i> <small>Previous Article</small>
                                </span><strong>How to Become a Cyber Security Engineer: Job Details and Skills
                                </strong></a><a class="post_item" href="#!"><span><i
                                        class="far fa-arrow-right"></i> <small>Next Article</small>
                                </span><strong>4 Ideas to Improve Learning in the Flow of Work</strong></a>
                        </div>
                        <div class="comments_list_wrap">
                            <h3 class="details_info_title">2 Comments</h3>
                            <ul class="comments_list unordered_list_block">
                                <li>
                                    <div class="comment_item">
                                        <div class="comment_author">
                                            <div class="author_thumbnail"><img
                                                    src="collab/assets/images/meta/student_thumbnail_6.jpg"
                                                    alt="Collab – Online Learning Platform"></div>
                                            <div class="author_content">
                                                <h4 class="author_name">Carolyn Wallace</h4><span
                                                    class="comment_date">January 27, 2023</span>
                                            </div>
                                        </div>
                                        <p>Platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper
                                            dignissim cras. Vitae ultricies leo integer malesuada nunc vel. Nibh
                                            cras pulvinar mattis nunc sed. Convallis a cras semper auctor neque
                                            vitae tempus. Mattis molestie a iaculis at erat pellentesque
                                            adipiscing.</p><a class="reply_btn" href="#!"><i
                                                class="fas fa-reply"></i> Reply</a>
                                    </div>
                                    <ul class="comments_list unordered_list_block">
                                        <li>
                                            <div class="comment_item">
                                                <div class="comment_author">
                                                    <div class="author_thumbnail"><img
                                                            src="collab/assets/images/meta/testimonial_thumbnail_1.jpg"
                                                            alt="Collab – Online Learning Platform"></div>
                                                    <div class="author_content">
                                                        <h4 class="author_name">Ray Cooper</h4><span
                                                            class="comment_date">January 27, 2023</span>
                                                    </div>
                                                </div>
                                                <p>Platea dictumst vestibulum rhoncus est pellentesque elit
                                                    ullamcorper dignissim cras. Vitae ultricies leo integer
                                                    malesuada nunc vel. Nibh cras pulvinar mattis nunc sed.
                                                    Convallis a cras semper auctor neque vitae tempus. Mattis
                                                    molestie a iaculis at erat pellentesque adipiscing.</p><a
                                                    class="reply_btn" href="#!"><i class="fas fa-reply"></i>
                                                    Reply</a>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                <li>
                                    <div class="comment_item">
                                        <div class="comment_author">
                                            <div class="author_thumbnail"><img
                                                    src="collab/assets/images/meta/student_thumbnail_7.jpg"
                                                    alt="Collab – Online Learning Platform"></div>
                                            <div class="author_content">
                                                <h4 class="author_name">Marrion Willsoriam</h4><span
                                                    class="comment_date">January 27, 2023</span>
                                            </div>
                                        </div>
                                        <p>Platea dictumst vestibulum rhoncus est pellentesque elit ullamcorper
                                            dignissim cras. Vitae ultricies leo integer malesuada nunc vel. Nibh
                                            cras pulvinar mattis nunc sed. Convallis a cras semper auctor neque
                                            vitae tempus. Mattis molestie a iaculis at erat pellentesque
                                            adipiscing.</p><a class="reply_btn" href="#!"><i
                                                class="fas fa-reply"></i> Reply</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="comment_form_wrap">
                            <h3 class="details_info_title">Leave a Reply</h3>
                            <form action="#">
                                <div class="row">
                                    <div class="col">
                                        <div class="form_item mb-0"><label for="input_message"
                                                class="input_title text-uppercase">Message</label>
                                            <textarea id="input_message" name="comment" placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                    <div class="col col-md-6">
                                        <div class="form_item mb-0"><label for="input_name"
                                                class="input_title">Name</label> <input id="input_name"
                                                type="text" placeholder="Your Name"></div>
                                    </div>
                                    <div class="col col-md-6">
                                        <div class="form_item mb-0"><label for="input_email"
                                                class="input_title">Email</label> <input id="input_email"
                                                type="email" placeholder="Your Email"></div>
                                    </div>
                                    <div class="col">
                                        <div class="checkbox_item"><input id="checkbox_remember" type="checkbox">
                                            <label for="checkbox_remember">Save my name,
                                                email, and website in this browser for the next time I
                                                comment.</label>
                                        </div><button type="submit" class="btn btn_dark"><span><small>Submit
                                                    Comment</small>
                                                <small>Submit Comment</small></span></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-4">
                    <aside class="sidebar ps-lg-4">
                        <div class="widget">
                            <div class="widget_title" role="button" data-bs-toggle="collapse"
                                data-bs-target="#collapse_category" aria-expanded="true"
                                aria-controls="collapse_category">Category</div>
                            <div class="collapse show" id="collapse_category">
                                <div class="card card-body">
                                    <div class="checkbox_item"><input id="checkbox_design" type="checkbox">
                                        <label for="checkbox_design"><span>Design</span><span>(18)</span></label>
                                    </div>
                                    <div class="checkbox_item"><input id="checkbox_it_software" type="checkbox">
                                        <label for="checkbox_it_software"><span>IT &
                                                Software</span><span>(11)</span></label>
                                    </div>
                                    <div class="checkbox_item"><input id="checkbox_development" type="checkbox">
                                        <label
                                            for="checkbox_development"><span>Development</span><span>(10)</span></label>
                                    </div>
                                    <div class="checkbox_item"><input id="checkbox_marketing" type="checkbox">
                                        <label for="checkbox_marketing"><span>Marketing</span><span>(4)</span></label>
                                    </div>
                                    <div class="checkbox_item"><input id="checkbox_business" type="checkbox">
                                        <label for="checkbox_business"><span>Business</span><span>(8)</span></label>
                                    </div>
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
                                        <li><a class="blog_small" href="blog_details.html"><span
                                                    class="item_image"><img
                                                        src="collab/assets/images/blog/blog_small_img_3.jpg"
                                                        alt="Collab – Online Learning Platform"> </span><span
                                                    class="item_content"><span class="item_author"><i
                                                            class="fas fa-user-alt"></i> by Corabelle
                                                        Durrad</span> <strong class="item_title">See How
                                                        Michaele Built a New Life and Career </strong><small
                                                        class="item_post_date">October 12,
                                                        2023</small></span></a></li>
                                        <li><a class="blog_small" href="blog_details.html"><span
                                                    class="item_image"><img
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
                                        <li><a href="#!">Project Management</a></li>
                                        <li><a href="#!">Engineer</a></li>
                                        <li><a href="#!">Network</a></li>
                                        <li><a href="#!">Systems</a></li>
                                        <li><a href="#!">Security</a></li>
                                        <li><a href="#!">IT & Software</a></li>
                                        <li><a href="#!">Career</a></li>
                                        <li><a href="#!">IT & Software</a></li>
                                        <li><a href="#!">IT & Software</a></li>
                                        <li><a href="#!">Hard Skills</a></li>
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
    <section class="blog_section section_space_lg">
        <div class="container">
            <div class="section_heading">
                <div class="row align-items-center">
                    <div class="col col-lg-5">
                        <h2 class="heading_text mb-lg-0">Articles</h2>
                    </div>
                    <div class="col col-lg-7 d-none d-lg-flex justify-content-end">
                        <div class="btn_wrap p-0"><a class="btn border_dark" href="blog.html"><span><small>All
                                        Articles</small> <small>All Articles</small></span></a></div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col col-lg-4">
                    <div class="blog_item">
                        <ul class="item_category_list unordered_list">
                            <li><a href="#!">Photography</a></li>
                        </ul>
                        <div class="item_image"><a href="blog_details.html" data-cursor-text="View"><img
                                    src="collab/assets/images/blog/blog_img_1.jpg"
                                    alt="Collab – Online Learning Platform"></a></div>
                        <div class="item_content">
                            <h3 class="item_title"><a href="blog_details.html">The Top Technical Skills All
                                    Employees Need in 2023</a></h3><a class="btn_unfill"
                                href="blog_details.html"><span class="btn_text">Read Articles</span> <span
                                    class="btn_icon"><i class="fas fa-long-arrow-right"></i> <i
                                        class="fas fa-long-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-4">
                    <div class="blog_item">
                        <ul class="item_category_list unordered_list">
                            <li><a href="#!">Photography</a></li>
                        </ul>
                        <div class="item_image"><a href="blog_details.html" data-cursor-text="View"><img
                                    src="collab/assets/images/blog/blog_img_2.jpg"
                                    alt="Collab – Online Learning Platform"></a></div>
                        <div class="item_content">
                            <h3 class="item_title"><a href="blog_details.html">The Best Graphic Design Careers —
                                    for Beginners and Professionals</a></h3><a class="btn_unfill"
                                href="blog_details.html"><span class="btn_text">Read Articles</span> <span
                                    class="btn_icon"><i class="fas fa-long-arrow-right"></i> <i
                                        class="fas fa-long-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
                <div class="col col-lg-4">
                    <div class="blog_item">
                        <ul class="item_category_list unordered_list">
                            <li><a href="#!">Photography</a></li>
                        </ul>
                        <div class="item_image"><a href="blog_details.html" data-cursor-text="View"><img
                                    src="collab/assets/images/blog/blog_img_3.jpg"
                                    alt="Collab – Online Learning Platform"></a></div>
                        <div class="item_content">
                            <h3 class="item_title"><a href="blog_details.html">Ubuntu vs. Windows: Which OS
                                    Should You Use in 2023?</a></h3><a class="btn_unfill"
                                href="blog_details.html"><span class="btn_text">Read Articles</span> <span
                                    class="btn_icon"><i class="fas fa-long-arrow-right"></i> <i
                                        class="fas fa-long-arrow-right"></i></span></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn_wrap d-block d-lg-none pb-0 text-center"><a class="btn border_dark"
                    href="blog.html"><span><small>All Articles</small> <small>All Articles</small></span></a>
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
    @push('styles')
        <style>
            .video-container {
                position: relative;
                width: 100%;
                margin: 20px 0;
                overflow: hidden;
                border-radius: 8px;
                background: #000;
            }

            .video-container video {
                width: 100%;
                height: auto;
                display: block;
                max-height: 600px;
            }

            .video-js {
                width: 100%;
                height: auto;
                aspect-ratio: 16/9;
            }

            .vjs-big-play-button {
                background-color: rgba(0, 0, 0, 0.5) !important;
            }

            .vjs-big-play-button:hover {
                background-color: rgba(0, 0, 0, 0.7) !important;
            }
        </style>
    @endpush
    @push('scripts')
        <!-- Video.js CSS -->
        <link href="https://vjs.zencdn.net/8.10.0/video-js.css" rel="stylesheet" />

        <!-- Video.js JavaScript -->
        <script src="https://vjs.zencdn.net/8.10.0/video.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                // Inicializar Video.js
                var player = videojs('player', {
                    controls: true,
                    autoplay: false,
                    preload: 'metadata',
                    fluid: true,
                    playbackRates: [0.5, 1, 1.5, 2],
                    controlBar: {
                        children: [
                            'playToggle',
                            'volumePanel',
                            'progressControl',
                            'currentTimeDisplay',
                            'timeDivider',
                            'durationDisplay',
                            'playbackRateMenuButton',
                            'fullscreenToggle'
                        ]
                    }
                });

                // Manejar errores de carga
                player.on('error', function() {
                    console.error('Error al cargar el video');
                    var errorMessage = document.createElement('div');
                    errorMessage.className = 'vjs-error-display';
                    errorMessage.innerHTML = 'Error al cargar el video. Por favor, intenta nuevamente.';
                    player.el().appendChild(errorMessage);
                });

                // Optimizar para dispositivos móviles
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                    player.fluid(true);
                    player.width('100%');
                }
            });
        </script>
    @endpush
</x-frontend.web-layout>
