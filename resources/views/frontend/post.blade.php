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
                        <p class="page_description mb-0">{{ $post->excerpt }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="details_section blog_details_section section_space_lg pb-0">
        <div class="container">
            @livewire('blog.post-frontend', ['post' => $post])
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
