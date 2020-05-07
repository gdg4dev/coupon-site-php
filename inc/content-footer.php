<!-- Page Content Holder -->
<div id="content">
    <nav class="navbar navbar-expand-lg navbar-light bg-light m-0">
        <div class="container-fluid">
            <span id="head-logo">
                <h2><b id="nav-head-logo" style="
                                        background:  linear-gradient(to right, #E25B45 0%, #FAC172 100%);
                                        -webkit-background-clip: text;
                                        -webkit-text-fill-color: transparent;
                                    ">TECH BUD</b></h2>
            </span>
            <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse"
                data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <i class="fas fa-align-justify"></i>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link animating-link" href="#">Recently Added</a>
                    </li>
                    <li class="nav-item active" id="sidebarCollapse">
                        <a class="nav-link animating-link" id="cat-btn-lnk" href="#">Categories</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link animating-link" href="#">Most Popular</a>
                    </li>
                    <li class="nav-item active">
                        <a class="nav-link animating-link" href="#">Expires Soon</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</div>
</div>
</div>
</div>

<!--  VUE--> 
 <script>
    var title = new Vue({
    el: '#title',

    data:{
        title: "Tech Bud",
    }
})

  </script>
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
<!-- Popper.JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
<!-- Bootstrap JS -->
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue"></script>
<script src="script/script.js"></script>

</body>

</html>