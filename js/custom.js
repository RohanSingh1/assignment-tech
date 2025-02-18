document.addEventListener("DOMContentLoaded", function () {
    let page = 1;

    function updateQueryParams() {
        let params = {
            search: document.getElementById("project-search").value,
            filter_project_type: document.getElementById("filter-project-type").value,
            filter_city: document.getElementById("filter-city").value,
            filter_project_cat: document.getElementById("filter-category").value
        };

        // Remove empty parameters
        let filteredParams = Object.fromEntries(Object.entries(params).filter(([_, value]) => value));

        let queryString = new URLSearchParams(filteredParams).toString();
        history.pushState(null, "", "?" + queryString); // Update URL parameters
    }

    function fetchProjects() {
        let data = new FormData();
        data.append("action", "filter_projects");
        data.append("page", page);
        data.append("search", document.getElementById("project-search").value);
        data.append("filter_project_type", document.getElementById("filter-project-type").value);
        data.append("filter_city", document.getElementById("filter-city").value);
        data.append("filter_project_cat", document.getElementById("filter-category").value);

        fetch(ajax_data.ajax_url, {
            method: "POST",
            body: data,
        })
        .then(response => response.text())
        .then(response => {
            let projectResults = document.getElementById("project-results");
            if (page === 1) {
                projectResults.innerHTML = response;
            } else {
                projectResults.insertAdjacentHTML("beforeend", response);
            }

            // Hide Load More button if no more projects
            let loadMoreBtn = document.getElementById("load-more");
            if (response.trim() === "" || response.includes("No projects found.")) {
                loadMoreBtn.style.display = "none";
            } else {
                loadMoreBtn.style.display = "block";
            }
        });
    }

    function applyFiltersFromURL() {
        let params = new URLSearchParams(window.location.search);

        document.getElementById("project-search").value = params.get("search") || "";
        document.getElementById("filter-project-type").value = params.get("filter_project_type") || "";
        document.getElementById("filter-city").value = params.get("filter_city") || "";
        document.getElementById("filter-category").value = params.get("filter_project_cat") || "";

        fetchProjects();
    }

    function addEventListeners() {
        document.getElementById("project-search").addEventListener("input", function () {
            page = 1;
            updateQueryParams();
            fetchProjects();
        });

        document.querySelectorAll("select").forEach(select => {
            select.addEventListener("change", function () {
                page = 1;
                updateQueryParams();
                fetchProjects();
            });
        });

        document.getElementById("load-more").addEventListener("click", function () {
            page++;
            fetchProjects();
        });

        document.getElementById("clear-all").addEventListener("click", function () {
            document.getElementById("project-search").value = "";
            document.getElementById("filter-project-type").value = "";
            document.getElementById("filter-city").value = "";
            document.getElementById("filter-category").value = "";

            page = 1;
            updateQueryParams();
            fetchProjects();
        });
    }

    applyFiltersFromURL();
    addEventListeners();
});

// menu toggle
document.addEventListener("DOMContentLoaded", function () {
    const menuToggle = document.querySelector(".menu-toggle");
    const menu = document.querySelector(".main-menu");

    menuToggle.addEventListener("click", function () {
        const isExpanded = menuToggle.getAttribute("aria-expanded") === "true";
        menuToggle.setAttribute("aria-expanded", !isExpanded);
        menu.classList.toggle("active");
    });
});


jQuery(document).ready(function($) {
    $('.featured-product-slider').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        autoplaySpeed: 3000,
        arrows: true,
        dots: true,
        infinite: true,
        adaptiveHeight: true
    });
});
