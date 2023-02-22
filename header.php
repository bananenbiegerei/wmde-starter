<!DOCTYPE html>
<html <?php language_attributes(); ?> class="h-full no-js" data-theme="wmde">
<?php get_template_part('head'); ?>
<?php
$site_title = get_bloginfo('name');
$site_url = network_site_url('/');
$site_description = get_bloginfo('description');

//echo 'The Network Home URL is: ' . $site_url;
//echo 'The Network Home Name is: ' . $site_title;
//echo 'The Network Home Tagline is: ' . $site_description;
?>
<body <?php body_class(); ?>>
    <!--
        FIXME: split desktop and mobile versions (this is becomig too complex...)
        FIXME: get measurements dynamically
        FIXME: simplify!
    -->
    <script>
        // Get current page ID (used to set 'current' class to menu item)
        const pageID = <?php echo get_the_ID(); ?>;
        // Get content of top-nav menu
        var WPNav = JSON.parse('<?php echo json_encode(bb_get_nav_menu()); ?>');
    
        // Breakpoint for large
        const lgWidth = 1024;
        if (typeof(TW) !== 'undefined') {
            lgWidth = parseInt(TW.fullConfig.theme.screens.lg);
        }
    
        // Default icon when featured page thumbnail is missing
        const defaultIcon = "<?php echo get_stylesheet_directory_uri(); ?>/img/placeholders/wiki-logo-icon.png";
    
        // Store site header status in Alpine.store
        document.addEventListener('alpine:init', () => {
            Alpine.store('open_mobile_nav', window.innerWidth >= lgWidth ? true : false);
        });
    
        // Prepare x-data for 'navMenu' component
        document.addEventListener('alpine:init', () => {
            Alpine.data('navMenu', () => ({
                nav: WPNav,
                isOpen: new Array(WPNav.length).fill(false),
                timeOutFunctionId: 0,
                idx: -1,
                init() {
                    // Set site header to visible each time we resize to bigger than lgWidth
                    // This bit is to do this only after we stop resizing and not during the whole resizing...
                    window.onresize = function() {
                        clearTimeout(this.timeOutFunctionId);
                        this.timeOutFunctionId = setTimeout(function() {
                            if (window.innerWidth >= lgWidth) {
                            Alpine.store('open_mobile_nav', true);
                            } else {
                                Alpine.store('open_mobile_nav', false);
                            }
                        }, 50);
                    };
                },
                toggleNav(n) {
                    var v = this.isOpen[n];
                    this.isOpen.fill(false);
                    this.isOpen[n] = !v;
                    this.idx = this.isOpen[n] ? n : -1;
                },
                openNav(n) {
                    var v = this.isOpen[n];
                    this.isOpen.fill(false);
                    this.isOpen[n] = true;
                    this.idx = n;
                },
                closeNav() {
                    this.isOpen.fill(false);
                    this.idx = -1;
                },
                movePointer() {
                    if (this.idx === -1) {
                        return;
                    }
                    var bx = document.getElementById('menu' + this.idx).getBoundingClientRect().left; // button x
                    var bw = document.getElementById('menu' + this.idx).offsetWidth; // button width
                    // FIXME: get these values dynamically...
                    var dxoff = 16; // dropdown h offset
                    var pw = 42; // pointer width
                    var pyoff = -30; // pointer v offset
                    document.getElementById('pointer').style.left = bx - dxoff + bw/2 - pw/2 + 'px';
                    document.getElementById('pointer').style.top = pyoff + 'px';
                }
            }));
        });
    </script>
    
    
    <div class="z-10">
        <!-- Site header -->
        <?php get_template_part('template-parts/header-top'); ?>
    </div>
    <?php get_template_part('template-parts/header-bottom'); ?>
    

    <main class="main-content min-h-screen mt-16">
