<?php
// Getting active directory
$directoryURI = $_SERVER['REQUEST_URI'];
$path = parse_url($directoryURI, PHP_URL_PATH);
$components = explode('/', $path);
$page = $components[3];

$page = ucfirst(str_replace("-", " ", $page));
$remove = str_replace(".php", "", $page);
$currentpage = $remove;

// var_dump($page); -- for checking/debugging
?>
<nav class="sub-navbar">
    <a class="route" href="dashboard.php">
        <span class="arrow-icon fa fa-solid fa-chevron-left">
            &nbsp;&nbsp;&nbsp;<?php echo $currentpage; ?>
        </span>
    </a>
</nav>