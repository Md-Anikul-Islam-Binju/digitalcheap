<template>
    <nav class="navbar navbar-expand-lg bg-body-tertiary rounded" aria-label="Thirteenth navbar example">
        <div class="container">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarsExample11"
                    aria-controls="navbarsExample11" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse d-lg-flex" id="navbarsExample11">
                <a class="navbar-brand col-lg-3 me-0 mt-2 mt-lg-0" href="#">
                    <img src="frontend/images/logo.jpg" class="w-50 h-auto" alt="" />
                </a>
                <ul class="navbar-nav col-lg-4 justify-content-lg-center">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                        <Link class="nav-link" href="/about">About</Link>
                    </li>





                    <li class="nav-item dropdown ">
                        <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">Categories</a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="#">SEO</a></li>
                            <li><a class="dropdown-item" href="#">Sports</a></li>
                            <li><a class="dropdown-item" href="#">AI</a></li>
                            <li><a class="dropdown-item" href="#">OTT</a></li>
                        </ul>
                    </li>
                </ul>

                <div class="d-lg-flex col-lg-5 justify-content-lg-end align-items-center gap-2">
                    <form role="search">
                        <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                    </form>
                    <a class="btn btn-outline-success" href="#">Login</a>
                    <a class="btn btn-success" href="#">Sign Up</a>
                </div>
            </div>
        </div>
    </nav>
</template>
<script>
export default {
    name: "Navbar",
}
</script>
<style scoped>

</style>
