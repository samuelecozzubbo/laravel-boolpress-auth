<aside class="text-bg-dark">
    <ul>
        <li>
            <a href="{{ route('admin.home') }}"><i class="fa-solid fa-house"></i> <span
                    class="d-md-none d-lg-inline-block">HOME</span></a>
        </li>
        <li>
            <a href="{{ route('admin.posts.index') }}"><i class="fa-solid fa-list"></i> Elenco post</a>
        </li>
        <li>
            <a href="{{ route('admin.posts.create') }}"><i class="fa-solid fa-newspaper"></i> Nuovo post</a>
        </li>
        <li>
            <a href="{{ route('admin.categories.index') }}"><i class="fa-solid fa-pen-to-square"></i>Gestione
                categorie</a>
        </li>
        <li>
            <a href="{{ route('admin.categoryPosts') }}"><i class="fa-solid fa-layer-group"></i>Post per categorie</a>
        </li>
        <li>
            <a href="{{ route('admin.posts.trash') }}"><i class="fa-solid fa-trash"></i>Post Eliminati</a>
        </li>
    </ul>
</aside>
