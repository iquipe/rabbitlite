<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Documentation - RabbitLite</title>

    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="assets/font/bootstrap-icons.css">

    <style>
    /* --- Color Palette (Consistent Theme) --- */
    :root {
        --primary-100: #FFFFFF;
        --primary-200: #e0e0e0;
        --primary-300: #9b9b9b;
        --accent-100: #FFD700;
        /* Gold */
        --accent-200: #c7a700;
        /* Darker Gold */
        --text-100: #FFFFFF;
        --text-200: #e0e0e0;
        --bg-100: #0F1626;
        /* Main BG */
        --bg-200: #1e2436;
        /* Content Area BG */
        --bg-300: #363c54;
        /* Sidebar BG, Borders, Hover */
        --accent-100-rgb: 255, 215, 0;
        --code-bg: #0a0e14;
        /* Darker bg for code */
        --highlight-bg: rgba(var(--accent-100-rgb), 0.3);
        /* Search highlight */
    }

    /* --- General Styles --- */
    html {
        scroll-behavior: smooth;
        /* Enable smooth scrolling */
    }

    body {
        background-color: var(--bg-100);
        color: var(--text-200);
        font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Helvetica, Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
        line-height: 1.7;
        /* Enable Scrollspy */
        position: relative;
    }

    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
        color: var(--text-100);
        margin-top: 1.5rem;
        margin-bottom: 0.8rem;
    }

    h1 {
        color: var(--accent-100);
        margin-top: 0;
    }

    a {
        color: var(--accent-100);
        text-decoration: none;
    }

    a:hover {
        color: var(--accent-200);
    }

    /* --- Preloader (Consistent) --- */
    #preloader {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: var(--bg-100);
        display: flex;
        justify-content: center;
        align-items: center;
        z-index: 9999;
        opacity: 1;
        transition: opacity 0.5s ease-out;
    }

    #preloader.fade-out {
        opacity: 0;
        pointer-events: none;
    }

    .spinner-border.text-accent-100 {
        color: var(--accent-100) !important;
        width: 3rem;
        height: 3rem;
    }

    /* --- Layout: Sidebar + Content --- */
    .main-wrapper {
        padding-top: 1rem;
        /* Space from top */
    }

    /* --- Sidebar (Navigation) --- */
    #helpSidebar {
        background-color: var(--bg-300);
        padding: 1.5rem 1rem;
        border-radius: 8px;
        height: calc(100vh - 40px);
        /* Adjust based on header/padding */
        overflow-y: auto;
        /* Scroll sidebar if content overflows */
        position: sticky;
        /* Keep sidebar visible */
        top: 20px;
        /* Sticky offset from top */
    }

    #helpSidebar h5 {
        color: var(--accent-100);
        margin-bottom: 1rem;
        padding-bottom: 0.5rem;
        border-bottom: 1px solid var(--bg-200);
    }

    .sidebar-nav .nav-link {
        color: var(--primary-200);
        padding: 0.4rem 1rem;
        font-size: 0.95rem;
        border-radius: 4px;
        margin-bottom: 2px;
        transition: background-color 0.2s ease, color 0.2s ease;
    }

    .sidebar-nav .nav-link:hover {
        background-color: var(--bg-200);
        color: var(--text-100);
    }

    .sidebar-nav .nav-link.active {
        background-color: var(--accent-100);
        color: var(--bg-100);
        /* Dark text on accent */
        font-weight: bold;
    }

    /* Nested Nav styling */
    .sidebar-nav .nav .nav-link {
        padding-left: 2rem;
        /* Indent sub-items */
        font-size: 0.9rem;
        color: var(--primary-300);
    }

    .sidebar-nav .nav .nav-link:hover {
        color: var(--text-100);
    }

    .sidebar-nav .nav .nav-link.active {
        color: var(--bg-100);
        /* Keep dark text */
        font-weight: normal;
        /* Might not need bold for sub-items */
    }


    /* --- Search Bar --- */
    .search-container {
        margin-bottom: 1.5rem;
        padding: 1rem;
        background-color: var(--bg-200);
        border-radius: 6px;
        border: 1px solid var(--bg-300);
    }

    .search-container .form-control {
        background-color: var(--bg-100);
        color: var(--text-100);
        border-color: var(--primary-300);
    }

    .search-container .form-control:focus {
        background-color: var(--bg-300);
        border-color: var(--accent-100);
        box-shadow: 0 0 0 0.2rem rgba(var(--accent-100-rgb), 0.25);
    }

    .search-container .btn-search {
        background-color: var(--accent-100);
        border-color: var(--accent-100);
        color: var(--bg-100);
    }

    .search-container .btn-search:hover {
        background-color: var(--accent-200);
        border-color: var(--accent-200);
    }

    /* --- Main Content Area --- */
    #helpContent {
        background-color: var(--bg-200);
        padding: 2rem 2.5rem;
        border-radius: 8px;
        border: 1px solid var(--bg-300);
        min-height: calc(100vh - 40px);
        /* Ensure it takes height */
    }

    .help-section {
        margin-bottom: 2.5rem;
        padding-bottom: 1.5rem;
        border-bottom: 1px dashed var(--bg-300);
        /* Separator */
    }

    .help-section:last-child {
        border-bottom: none;
    }

    /* Content Elements */
    #helpContent p {
        margin-bottom: 1rem;
    }

    #helpContent code {
        background-color: var(--code-bg);
        color: var(--primary-200);
        padding: 0.2em 0.4em;
        border-radius: 3px;
        font-size: 0.9em;
    }

    #helpContent pre {
        background-color: var(--code-bg);
        color: var(--primary-200);
        padding: 1rem;
        border-radius: 5px;
        overflow-x: auto;
        /* Scroll long code blocks */
        border: 1px solid var(--bg-300);
    }

    #helpContent pre code {
        background-color: transparent;
        /* Remove bg for code inside pre */
        padding: 0;
        border-radius: 0;
    }

    #helpContent img {
        max-width: 100%;
        height: auto;
        border-radius: 4px;
        margin-top: 0.5rem;
        margin-bottom: 1rem;
        border: 1px solid var(--bg-300);
    }

    #helpContent ul,
    #helpContent ol {
        padding-left: 2rem;
        margin-bottom: 1rem;
    }

    #helpContent blockquote {
        border-left: 4px solid var(--accent-100);
        padding-left: 1rem;
        margin-left: 0;
        color: var(--primary-300);
        font-style: italic;
    }

    /* Search Highlight */
    .highlight {
        background-color: var(--highlight-bg);
        padding: 0.1em;
        border-radius: 2px;
        font-weight: bold;
        color: var(--accent-100);
    }
    </style>
</head>
<!-- Enable Bootstrap Scrollspy -->

<body data-bs-spy="scroll" data-bs-target="#helpSidebarNav" data-bs-offset="100">

    <!-- Preloader -->
    <div id="preloader">
        <div class="spinner-border text-accent-100" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <!-- Main Wrapper -->
    <div class="container-fluid main-wrapper">
        <div class="row">

            <!-- Sidebar Column -->
            <div class="col-lg-3">
                <aside id="helpSidebar">
                    <h5><i class="bi bi-book-half me-2"></i>Navigation</h5>
                    <!-- Sidebar Navigation -->
                    <nav class="nav sidebar-nav flex-column" id="helpSidebarNav">
                        <a class="nav-link active" href="#getting-started">Getting Started</a>
                        <a class="nav-link" href="#doc-index">index</a>
                        <a class="nav-link" href="#doc-global">global</a>
                        <a class="nav-link" href="#doc-controller">controller</a>
                        <a class="nav-link" href="#doc-database">database</a>
                        <a class="nav-link" href="#doc-function">function</a>
                        <a class="nav-link" href="#doc-navgations">navgation</a>
                        <a class="nav-link" href="#doc-action">action</a>
                        <a class="nav-link" href="#doc-path">Files Path</a>
                        <a class="nav-link" href="#doc-contact-support">Contact Support</a>
                    </nav>
                </aside>
            </div>

            <!-- Content Column -->
            <div class="col-lg-9">
               
                <!-- Help Content Area -->
                <main id="helpContent">
                    <h1 class="mb-4">Help Documentation</h1>

                    <!-- Section: Getting Started -->
                    <section id="getting-started" class="help-section">
                        <?=$parsedown->text(file_get_contents('./_doc/help.md'));?>
                    </section>

                    <!-- Section: Fee Payments -->
                    <section id="doc-index" class="help-section">
                        <?=$parsedown->text(file_get_contents('./_doc/index.md'));?>
                    </section>

                    <!-- Section: Student Profiles -->
                    <section id="doc-global" class="help-section">
                        <?=$parsedown->text(file_get_contents('./_doc/global.md'));?>
                    </section>

                    <!-- Section: Account Settings -->
                    <section id="doc-controller" class="help-section">
                        <?=$parsedown->text(file_get_contents('./_doc/controller.md'));?>
                    </section>

                    <!-- Section: Troubleshooting -->
                    <section id="doc-database" class="help-section">
                        <?=$parsedown->text(file_get_contents('./_doc/database.md'));?>
                    </section>

                    <!-- Section: Contact Support -->
                    <section id="doc-function" class="help-section">
                        <?=$parsedown->text(file_get_contents('./_doc/functions.md'));?>
                    </section>
                    <!-- Section: Contact Support -->
                    <section id="doc-navgations" class="help-section">
                        <?=$parsedown->text(file_get_contents('./_doc/navgation.md'));?>
                    </section>
                    <!-- Section: Contact Support -->
                    <section id="doc-action" class="help-section">
                        <?=$parsedown->text(file_get_contents('./_doc/action.md'));?>
                    </section>
                    <!-- Section: Contact Support -->
                    <section id="doc-path" class="help-section">
                        <?=$parsedown->text(file_get_contents('./_doc/path.md'));?>
                    </section>
                    <!-- Section: Contact Support -->
                    <section id="doc-contact-support" class="help-section">
                        <?=$parsedown->text(file_get_contents('./_doc/contact-support.md'));?>
                    </section>

                </main> <!-- End helpContent -->
            </div> <!-- End Content Column -->

        </div> <!-- End Row -->
    </div> <!-- End Main Wrapper -->

    <!-- Bootstrap Bundle with Popper -->
    <script src="assets/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script>
    // --- Preloader ---
    window.addEventListener('load', () => {
        const preloader = document.getElementById('preloader');
        if (preloader) {
            setTimeout(() => {
                preloader.classList.add('fade-out');
            }, 200);
        }
    });

    // --- Initialize Bootstrap Scrollspy ---
    var scrollSpy = new bootstrap.ScrollSpy(document.body, {
        target: '#helpSidebarNav',
        offset: 120 // Adjust offset based on your layout/sticky header height
    });


    // --- Basic Client-Side Search ---
    const searchInput = document.getElementById('searchInput');
    const searchButton = document.getElementById('searchButton');
    const contentArea = document.getElementById('helpContent');
    const allSections = contentArea.querySelectorAll('.help-section'); // Can search within sections
    const allContentElements = contentArea.querySelectorAll('p, h2, h3, h4, li'); // Elements to search within

    // Function to remove previous highlights
    function removeHighlights() {
        const highlighted = contentArea.querySelectorAll('.highlight');
        highlighted.forEach(el => {
            // Replace the highlighted span with its original text content
            el.outerHTML = el.innerHTML;
        });
        // Restore visibility of all sections/elements if hidden previously
        allSections.forEach(sec => sec.style.display = '');
        allContentElements.forEach(el => el.style.display = '');
    }

    // Function to perform search and highlight
    function performSearch() {
        removeHighlights(); // Clear previous results first
        const searchTerm = searchInput.value.trim().toLowerCase();

        if (searchTerm === '') {
            return; // Do nothing if search is empty
        }

        const regex = new RegExp(`(${searchTerm.replace(/[-\/\\^$*+?.()|[\]{}]/g, '\\$&')})`,
        'gi'); // Escape special chars
        let found = false;

        allContentElements.forEach(el => {
            const originalText = el.textContent;
            if (originalText.toLowerCase().includes(searchTerm)) {
                found = true;
                el.innerHTML = originalText.replace(regex, '<span class="highlight">$1</span>');
            }
        });

        // Optional: Hide sections that don't contain the search term (can be jarring)
        /*
        if (found) {
            allSections.forEach(sec => {
                if (!sec.querySelector('.highlight')) {
                    sec.style.display = 'none';
                } else {
                     sec.style.display = ''; // Ensure sections with hits are visible
                }
            });
        } else {
            // Handle no results found - maybe display a message
             console.log("No results found for:", searchTerm);
        }
        */
    }

    searchButton.addEventListener('click', performSearch);
    searchInput.addEventListener('keyup', function(event) {
        // Trigger search on Enter key
        if (event.key === 'Enter') {
            performSearch();
        }
        // Clear highlights if search input is cleared
        if (searchInput.value.trim() === '') {
            removeHighlights();
        }
    });
    </script>

</body>

</html>