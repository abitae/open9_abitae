<div class="row">
    @if ($category_id || $tag_id)
        <a href="{{ route('frontend.blog') }}" class="btn btn-primary mb-3">
            <i class="fas fa-times-circle"></i> Limpiar filtros
        </a>
    @endif

    <div class="col col-lg-8">
        <div class="row">
            @forelse ($posts as $post)
                <div wire:key="post-{{ $post->id }}" class="col col-lg-6 mb-4">
                    <div class="blog_item h-100">
                        <ul class="item_category_list unordered_list">
                            <li>
                                <a href="#!" wire:click.prevent="$set('category_id', {{ $post->category_id }})">
                                    {{ $post->category->name }}
                                </a>
                            </li>
                        </ul>
                        <div class="item_image">
                            <a href="{{ route('frontend.post', $post->slug) }}" data-cursor-text="Ver">
                                @if ($post->image_path)
                                    <img src="{{ Storage::url($post->image_path) }}"
                                         alt="{{ $post->title }}"
                                         class="img-fluid"
                                         loading="lazy">
                                @else
                                    <img src="{{ asset('collab/assets/images/blog/blog_small_img_3.jpg') }}"
                                         alt="{{ $post->title }}"
                                         class="img-fluid"
                                         loading="lazy">
                                @endif
                            </a>
                        </div>
                        <div class="item_content">
                            <ul class="meta_info_list unordered_list">
                                <li>
                                    <a href="#!">
                                        <i class="fas fa-user"></i>
                                        <span>{{ $post->user->name }}</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="#!">
                                        <i class="fas fa-calendar-day"></i>
                                        <span>{{ $post->created_at->format('d/m/Y') }}</span>
                                    </a>
                                </li>
                            </ul>
                            <h3 class="item_title">
                                <a href="{{ route('frontend.post', $post->slug) }}">
                                    {{ Str::limit($post->title, 60) }}
                                </a>
                            </h3>
                            <p class="item_description">{{ Str::limit($post->excerpt, 120) }}</p>
                            <ul class="meta_info_list unordered_list">
                                @forelse ($post->tags->take(3) as $tag)
                                    <li>
                                        <a href="#!" wire:click.prevent="tag({{ $tag->id }})">
                                            <i class="fas fa-thumbtack"></i>
                                            <span>{{ $tag->name }}</span>
                                        </a>
                                    </li>
                                @empty
                                    <li>
                                        <a href="#!">
                                            <i class="fas fa-thumbtack"></i>
                                            <span>Sin etiquetas</span>
                                        </a>
                                    </li>
                                @endforelse
                            </ul>
                            <a class="btn_unfill" href="{{ route('frontend.post', $post->slug) }}">
                                <span class="btn_text">Leer más</span>
                                <span class="btn_icon">
                                    <i class="fas fa-long-arrow-right"></i>
                                    <i class="fas fa-long-arrow-right"></i>
                                </span>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <p>No se encontraron artículos que coincidan con tu búsqueda.</p>
                </div>
            @endforelse
        </div>
        <div class="pagination-container">
            {{ $posts->links('vendor.pagination.blog-paginate') }}
        </div>
    </div>

    <div class="col col-lg-4">
        <aside class="sidebar ps-lg-4">
            {{-- Buscador --}}
            <div class="widget">
                <div class="search-container position-relative">
                    <input class="form-control"
                           type="text"
                           wire:model.live.debounce.300ms="search"
                           placeholder="Buscar artículos...">
                    <i class="fas fa-search position-absolute" style="right: 10px; top: 10px;"></i>
                </div>
            </div>

            {{-- Categorías --}}
            <div class="widget">
                <div class="widget_title" role="button" data-bs-toggle="collapse" data-bs-target="#collapse_category"
                    aria-expanded="true" aria-controls="collapse_category">
                    Categorías
                </div>
                <div class="collapse show" id="collapse_category">
                    <div class="card card-body">
                        @forelse ($categories as $category)
                            <div class="d-flex justify-content-between align-items-center py-1.5">
                                <div class="form-check">
                                    <input wire:key="category-{{ $category->id }}"
                                           wire:model.live="category_id"
                                           id="category-{{ $category->id }}"
                                           value="{{ $category->id }}"
                                           type="radio"
                                           class="form-check-input">
                                    <label for="category-{{ $category->id }}" class="form-check-label">
                                        {{ $category->name }}
                                    </label>
                                </div>
                                <span class="badge bg-light text-dark">{{ $category->posts_count }}</span>
                            </div>
                        @empty
                            <div class="text-center py-2">
                                <span class="text-muted">No hay categorías disponibles</span>
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

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

            {{-- Comentarios recientes --}}
            <div class="widget">
                <div class="widget_title" role="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse_recent_comments" aria-expanded="true"
                    aria-controls="collapse_recent_comments">
                    Comentarios recientes
                </div>
                <div class="collapse show" id="collapse_recent_comments">
                    <div class="card card-body">
                        <ul class="recent_comments_list unordered_list_block">
                            @forelse ($comments as $comment)
                                <li>
                                    <a href="{{ route('frontend.post', $comment->post->slug) }}">
                                        <i class="fas fa-comments"></i>
                                        <strong>{{ $comment->user->name }}</strong>
                                    </a>
                                    <span>{{ Str::limit($comment->content, 60) }}</span>
                                </li>
                            @empty
                                <li class="text-center py-2">
                                    <span class="text-muted">No hay comentarios disponibles</span>
                                </li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>

            {{-- Etiquetas --}}
            <div class="widget">
                <div class="widget_title" role="button" data-bs-toggle="collapse"
                    data-bs-target="#collapse_tags_list" aria-expanded="true"
                    aria-controls="collapse_tags_list">
                    Etiquetas
                </div>
                <div class="collapse show" id="collapse_tags_list">
                    <div class="card card-body">
                        <ul class="tags_list style_2 unordered_list">
                            @forelse ($tags->take(12) as $tag)
                                <li wire:key="tag-{{ $tag->id }}">
                                    <a href="#" wire:click.prevent="tag({{ $tag->id }})">
                                        {{ $tag->name }}
                                    </a>
                                </li>
                            @empty
                                <li><a href="#">Sin etiquetas</a></li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </aside>
    </div>
</div>
