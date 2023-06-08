<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link" href="{{ route('dashboard') }}">
                <i class="ti-shield menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('categories') }}">
                <i class="ti-layout-grid2 menu-icon"></i>
                <span class="menu-title">Categories</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('subcategories')}}">
                <i class="ti-layout-grid3 menu-icon"></i>
                <span class="menu-title">SubCategories</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('articles') }}">
                <i class="ti-files menu-icon"></i>
                <span class="menu-title">Articles</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('faqs') }}">
                <i class="ti-comments menu-icon"></i>
                <span class="menu-title">FAQ</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-bs-toggle="collapse" href="#ui-basic" aria-expanded="false"
                aria-controls="ui-basic">
                <i class="ti-book menu-icon"></i>
                <span class="menu-title">Privacy and Terms</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="ui-basic">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{ route('policies') }}">Privacy
                            Policy</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{ route('terms') }}">Term of Use</a>
                    </li>
                </ul>
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('about') }}">
                <i class="ti-more menu-icon"></i>
                <span class="menu-title">About Us</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('contacts') }}">
                <i class="ti-comment-alt menu-icon"></i>
                <span class="menu-title">Contacts</span><span id="conatcts-badge" class="d-none badge bg-danger">0</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('settings') }}">
                <i class="ti-settings menu-icon"></i>
                <span class="menu-title">Settings</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{ route('footer-links') }}">
                <i class="ti-link menu-icon"></i>
                <span class="menu-title">Footer Links</span>
            </a>
        </li>

    </ul>
</nav>

<script>
    $(document).ready(function() {
        loadNotification();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        function loadNotification() {
            $.ajax({
                type: "GET",
                url: "{{ route('contacts.notification') }}",
                dataType: 'json',
                data: { id: null },
                success: function(res) {
                    if(res > 0){
                        $('#conatcts-badge').removeClass("d-none");
                        $('#conatcts-badge').html(res);
                    }
                }
            });
        }
    });
</script>
