<x-frontend.web-layout>
    <section class="page_banner">
        <div class="container">
            <div class="content_wrapper" style="background-image:url(collab/assets/images/banner/page_banner_image.png)">
                <div class="row align-items-center">
                    <div class="col col-lg-6">
                        <ul class="breadcrumb_nav unordered_list">
                            <li><a href="{{ route('frontend.index') }}">Home</a></li>
                            <li>Blogs</li>
                        </ul>
                        <h1 class="page_title">Artículos</h1>
                        <p class="page_description">En esta sección encontrarás todos los artículos publicados por
                            nuestros expertos en el campo de la educación y el desarrollo personal.</p>
                        <form action="#">
                            <div class="form_item mb-0"><input type="search" name="search"
                                    placeholder="¿Qué quieres aprender?"> <button type="submit"
                                    class="btn btn_dark"><span><small>Buscar</small>
                                        <small>Buscar</small></span></button></div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="section_space_lg">
        <div class="container">
            @livewire('blog.blog-frontend')
        </div>
    </section>
</x-frontend.web-layout>
