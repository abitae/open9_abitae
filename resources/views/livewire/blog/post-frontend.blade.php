<div>
    <section class="blog_section section_space_lg">
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
                            @include('frontend.partials.random.redes_sociales')
                        </div>
                        @include('frontend.partials.random.autor')

                        <div class="prevnext_post_wrap">
                            @if($previousPost = $post->where('id', '<', $post->id)->orderBy('id', 'desc')->first())
                                <a class="post_item" href="{{ route('frontend.post', $previousPost->slug) }}">
                                    <span>
                                        <i class="far fa-arrow-left"></i>
                                        <small>Artículo anterior</small>
                                    </span>
                                    <strong>{{ $previousPost->title }}</strong>
                                </a>
                            @endif

                            @if($nextPost = $post->where('id', '>', $post->id)->orderBy('id', 'asc')->first())
                                <a class="post_item" href="{{ route('frontend.post', $nextPost->slug) }}">
                                    <span>
                                        <i class="far fa-arrow-right"></i>
                                        <small>Artículo siguiente</small>
                                    </span>
                                    <strong>{{ $nextPost->title }}</strong>
                                </a>
                            @endif
                        </div>
                        <div class="comments_list_wrap">
                            <h3 class="details_info_title">Comentarios</h3>
                            <ul class="comments_list unordered_list_block">
                                @forelse($post->comments->where('parent_id', null) as $comment)
                                    <li>
                                        <div class="comment_item">
                                            <div class="comment_author">
                                                <div class="author_thumbnail">
                                                    <img src="{{ $comment->user->profile_photo_url ?? asset('collab/assets/images/blog/blog_author_image.jpg') }}"
                                                         alt="{{ $comment->user->name }}"
                                                         loading="lazy">
                                                </div>
                                                <div class="author_content">
                                                    <h4 class="author_name">{{ $comment->user->name }}</h4>
                                                    <span class="comment_date">{{ $comment->created_at->format('d M, Y') }}</span>
                                                </div>
                                            </div>
                                            <p class="comment-content">{{ $comment->content }}</p>
                                            @auth
                                                <a class="reply_btn" href="#!" wire:click.prevent="$set('replyTo', {{ $comment->id }})" data-bs-toggle="modal" data-bs-target="#replyModal">
                                                    <i class="fas fa-reply"></i> Responder
                                                </a>
                                            @endauth
                                        </div>

                                        @if($comment->replies->count() > 0)
                                            <ul class="comments_list unordered_list_block replies-list">
                                                @foreach($comment->replies as $reply)
                                                    <li>
                                                        <div class="comment_item reply-item">
                                                            <div class="comment_author">
                                                                <div class="author_thumbnail">
                                                                    <img src="{{ $reply->user->profile_photo_url ?? asset('collab/assets/images/blog/blog_author_image.jpg') }}"
                                                                         alt="{{ $reply->user->name }}"
                                                                         loading="lazy">
                                                                </div>
                                                                <div class="author_content">
                                                                    <h4 class="author_name">{{ $reply->user->name }}</h4>
                                                                    <span class="comment_date">{{ $reply->created_at->format('d M, Y') }}</span>
                                                                </div>
                                                            </div>
                                                            <p class="reply-content">{{ $reply->content }}</p>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @empty
                                    <li class="text-center py-4">
                                        <i class="far fa-comments fa-2x mb-2 text-muted"></i>
                                        <p class="text-muted mb-0">No hay comentarios aún. ¡Sé el primero en comentar!</p>
                                    </li>
                                @endforelse
                            </ul>
                        </div>

                        <!-- Modal de Respuesta -->
                        <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true" wire:ignore.self>
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0 shadow">
                                    <div class="modal-header bg-light">
                                        <h5 class="modal-title" id="replyModalLabel">
                                            <i class="fas fa-reply me-2"></i>Responder comentario
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <form wire:submit.prevent="saveReply" class="needs-validation" novalidate>
                                            <div class="form_item mb-3">
                                                <label for="replyContent" class="form-label">Tu respuesta</label>
                                                <textarea id="replyContent"
                                                          wire:model.defer="content"
                                                          placeholder="Escribe tu respuesta aquí..."
                                                          class="form-control @error('content') is-invalid @enderror"
                                                          rows="4"
                                                          required></textarea>
                                                @error('content')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="d-flex justify-content-end gap-2">
                                                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                    <i class="fas fa-times me-1"></i> Cancelar
                                                </button>
                                                <button type="submit" class="btn btn-primary" wire:loading.attr="disabled">
                                                    <span wire:loading.remove wire:target="saveReply">
                                                        <i class="fas fa-paper-plane me-1"></i> Enviar
                                                    </span>
                                                    <span wire:loading wire:target="saveReply">
                                                        <i class="fas fa-spinner fa-spin me-1"></i> Enviando...
                                                    </span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="comment_form_wrap">
                            <h3 class="details_info_title">Deja un comentario</h3>
                            @auth
                                <form wire:submit.prevent="saveComment">
                                    <div class="form_item">
                                        <label for="input_message" class="input_title text-uppercase">Mensaje</label>
                                        <textarea id="input_message"
                                                  wire:model.defer="content"
                                                  placeholder="Escribe tu comentario aquí..."
                                                  class="form-control @error('content') is-invalid @enderror"
                                                  rows="4"></textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn_dark">
                                            <i class="fas fa-paper-plane me-2"></i>
                                            <span>
                                                <small>Publicar comentario</small>
                                                <small>Publicar comentario</small>
                                            </span>
                                        </button>
                                    </div>
                                </form>
                            @else
                                <div class="alert alert-info d-flex align-items-center">
                                    <i class="fas fa-info-circle me-2"></i>
                                    <p class="mb-0">Por favor <a href="{{ route('login') }}" class="alert-link">inicia sesión</a> para poder comentar.</p>
                                </div>
                            @endauth
                        </div>
                    </div>
                </div>
                <div class="col col-lg-4">
                    <aside class="sidebar ps-lg-4">
                        {{-- Artículos destacados --}}
                        <div class="widget">
                            <div class="widget_title" role="button" data-bs-toggle="collapse" data-bs-target="#collapse_blog"
                                aria-expanded="true" aria-controls="collapse_blog">
                                Artículos destacados
                            </div>
                            <div class="collapse show" id="collapse_blog">
                                <div class="card card-body">
                                    <ul class="blog_small_group unordered_list_block">
                                        @forelse ($featuredPosts as $post)
                                            <li>
                                                <a class="blog_small" href="{{ route('frontend.post', $post->slug) }}">
                                                    <span class="item_image">
                                                        @if ($post->image_path)
                                                            <img src="{{ Storage::url($post->image_path) }}"
                                                                 alt="{{ $post->title }}"
                                                                 loading="lazy">
                                                        @else
                                                            <img src="{{ asset('collab/assets/images/blog/blog_small_img_3.jpg') }}"
                                                                 alt="{{ $post->title }}"
                                                                 loading="lazy">
                                                        @endif
                                                    </span>
                                                    <span class="item_content">
                                                        <span class="item_author">
                                                            <i class="fas fa-user-alt"></i> por {{ $post->user->name }}
                                                        </span>
                                                        <strong class="item_title">{{ Str::limit($post->title, 40) }}</strong>
                                                        <small class="item_post_date">{{ $post->created_at->format('d/m/Y') }}</small>
                                                    </span>
                                                </a>
                                            </li>
                                        @empty
                                            <li class="text-center py-2">
                                                <span class="text-muted">No hay artículos disponibles</span>
                                            </li>
                                        @endforelse
                                    </ul>
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
                            <h2 class="heading_text">Suscríbete ahora y recibe un descuento del 20% en todos nuestros
                                cursos</h2>
                            <p class="heading_description mb-0"></p>
                        </div>
                        <form action="#">
                            <div class="form_item m-0"><input type="email" name="email"
                                    placeholder="Tu correo electrónico"> <button type="submit"
                                    class="btn btn_dark"><span><small>Suscríbete</small>
                                        <small>Suscríbete</small></span></button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
