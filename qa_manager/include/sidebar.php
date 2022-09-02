<ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #395B64;">

            <!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Hello<sup> Manager </sup></div>
            </a>

            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="fas fa-home"></i>
                    <span>Dashboard</span></a>
            </li>

            <!-- Divider -->
            <hr class="sidebar-divider">

            <li class="nav-item">
                <a class="nav-link collapsed" href="forum.php">
                    <i class="fas fa-list-ul"></i>
                    <span>Forum</span>
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsecomment"
                   aria-expanded="true" aria-controls="collapseTwo">
                    <i class="fas fa-comment"></i>
                    <span>Comments</span>
                </a>
                <div id="collapsecomment" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <!-- <h6 class="collapse-header">Custom Components:</h6> -->
                        <a class="collapse-item" href="latest_comments.php">Latest Comments</a>
                        <a class="collapse-item" href="anon_comments.php">Anonymous Comments</a>

                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="categories.php">
                    <i class="fas fa-toolbox"></i>
                    <span>Categories</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                   aria-expanded="true" aria-controls="collapsePages">
                   <i class="fas fa-list-alt"></i>
                    <span>Ideas</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">

                        <a class="collapse-item" href="add_idea.php">Post Idea</a>
                        <a class="collapse-item" href="your_idea.php">Your Idea</a>
                        <a class="collapse-item" href="view_all_ideas.php">View All Ideas</a>
                        <a class="collapse-item" href="most_viewed_ideas.php">Most Viewed Ideas</a>
                        <a class="collapse-item" href="latest_ideas.php">Latest Ideas</a>
                        <a class="collapse-item" href="popular_ideas.php">Popular Ideas</a>
                        <a class="collapse-item" href="ideas_w_comments.php">Ideas without comments</a>
                        <a class="collapse-item" href="anonymous_ideas.php">Anonymous Ideas</a>



                    </div>
                </div>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="download_data.php">
                    <i class="fas fa-download"></i>
                    <span>Download Document</span></a>
            </li>
             <!-- Divider -->
             <hr class="sidebar-divider d-none d-md-block"> 

                <!-- Sidebar Toggler (Sidebar) -->
                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>
        </ul>