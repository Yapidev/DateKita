<div>
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="{{ route('home') }}" class="text-nowrap logo-img" wire:navigate>
                <img src="{{ asset('assets/images/dark-logo.svg') }}"
                    class="dark-logo" width="180" alt="" />
                <img src="https://demos.adminmart.com/premium/bootstrap/modernize-bootstrap/package/dist/images/logos/light-logo.svg"
                    class="light-logo" width="180" alt="" />
            </a>
            <div class="close-btn d-lg-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8 text-muted"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar>
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('home') }}" aria-expanded="false" wire:navigate>
                        <span>
                            <i class="ti ti-home"></i>
                        </span>
                        <span class="hide-menu">Home</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('my-expense') }}" aria-expanded="false" wire:navigate>
                        <span>
                            <i class="ti ti-receipt-2"></i>
                        </span>
                        <span class="hide-menu">Pengeluaranku</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ route('note') }}" aria-expanded="false" wire:navigate>
                        <span>
                            <i class="ti ti-notebook"></i>
                        </span>
                        <span class="hide-menu">Note</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link" href="{{ Auth::user()->id == 1 ? '/chat/2' : 'chat/1' }}"
                        aria-expanded="false">
                        <span>
                            <i class="ti ti-messages"></i>
                        </span>
                        <span class="hide-menu">Chat</span>
                    </a>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
</div>
