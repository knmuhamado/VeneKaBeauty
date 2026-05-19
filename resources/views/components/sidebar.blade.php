{{-- Sidebar Drawer Component --}}
<div id="sidebar-overlay" class="sidebar-overlay"></div>

<aside id="sidebar-drawer" class="sidebar-drawer">
    <div class="sidebar-drawer__header">
        <span class="sidebar-drawer__title">{{ __('app.site_name') }}</span>
        <button id="sidebar-close" class="sidebar-drawer__close" aria-label="{{ __('app.close_menu') }}">
            <i class="bi bi-x-lg"></i>
        </button>
    </div>

    <nav class="sidebar-drawer__nav">
        @if(auth()->user()->isAdmin())
            <a href="{{ route('home.index') }}" class="sidebar-drawer__link">
                <i class="bi bi-house"></i>
                {{ __('app.sidebar_home') }}
            </a>
            <a href="{{ route('admin.product.index') }}" class="sidebar-drawer__link">
                <i class="bi bi-bag"></i>
                {{ __('app.nav_products') }}
            </a>
            <a href="{{ route('admin.product.create') }}" class="sidebar-drawer__link">
                <i class="bi bi-plus-circle"></i>
                {{ __('app.sidebar_new_product') }}
            </a>
            <a href="{{ route('admin.category.index') }}" class="sidebar-drawer__link">
                <i class="bi bi-tags"></i>
                {{ __('category.title') }}
            </a>
            <a href="{{ route('admin.category.create') }}" class="sidebar-drawer__link">
                <i class="bi bi-plus-square"></i>
                {{ __('app.sidebar_new_category') }}
            </a>

            <a href="{{ route('assistant.index') }}" class="sidebar-drawer__link">
                <i class="bi bi-robot"></i>
                {{ __('assistant.widget.eyebrow') }}
            </a>

            <a href="{{ route('allied.index') }}" class="sidebar-drawer__link">
                <i class="bi bi-shop me-1"></i>
                {{ __('allied.title') }}
            </a>

        @endif

        @if(auth()->user()->isClient())
            <a href="{{ route('home.index') }}" class="sidebar-drawer__link">
                <i class="bi bi-house"></i>
                {{ __('app.sidebar_home') }}
            </a>

            <a href="{{ route('product.index') }}" class="sidebar-drawer__link">
                <i class="bi bi-shop"></i>
                {{ __('app.nav_products') }}
            </a>

            <a href="{{ route('order.list') }}" class="sidebar-drawer__link">
                <i class="bi bi-bag-check"></i>
                {{ __('app.nav_my_orders') }}
            </a>

            <a href="{{ route('assistant.index') }}" class="sidebar-drawer__link">
                <i class="bi bi-robot"></i>
                {{ __('assistant.widget.eyebrow') }}
            </a>

            <a href="{{ route('allied.index') }}" class="sidebar-drawer__link">
                <i class="bi bi-shop me-1"></i>
                {{ __('allied.title') }}
            </a>
        
        @endif
    </nav>
</aside>
