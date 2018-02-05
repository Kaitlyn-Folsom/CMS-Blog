<?php include "components/header.php" ?>

<body>
		
		<!--Navigation-->
   <?php include "components/nav.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

					<!-- Blog Entries Column -->
					<div class="col-md-8">

						<?php
	
							if(isset($_GET['category'])) {
								$post_category_id = $_GET['category'];

								if(isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin') {
									$query = "SELECT * FROM posts WHERE post_category_id= $post_category_id";
								} else {
									$query = "SELECT * FROM posts WHERE post_category_id= $post_category_id AND post_status = 'published' ";
								}

							$select_all_posts_query = mysqli_query($connection, $query);

							if (mysqli_num_rows($select_all_posts_query) < 1) {
								echo "<h1 class='text-center'>No posts for this category</h1>";
							} else {

							while($row = mysqli_fetch_assoc($select_all_posts_query)) {
								$post_id = $row['post_id'];
								$posts_title = $row["post_title"];
								$posts_author = $row["post_author"];
								$posts_date = $row["post_date"];
								$posts_image = $row["post_image"];
								$posts_content = substr($row["post_content"], 0, 500);

								?>

							<!-- Blog Post -->
							<h2>
									<a href="post.php?p_id=<?php echo $post_id ?>"><?php echo $posts_title?></a>
							</h2>
								<p class="lead">
										by <a href="index.php"><?php echo $posts_author?></a>
								</p>
								<p><span class="glyphicon glyphicon-time"></span><?php echo $posts_date?></p>
								<hr>
								<img class="img-responsive" src="images/<?php echo $posts_image;?>" alt="">
								<hr>
								<p><?php echo $posts_content?></p>
								<a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>

							<hr>

						<?php	} } }else {
							header("Location: index.php");
							
							
							
							}?>
					</div>
            
					<!--	Sidebar-->
					<?php include "components/sidebar.php" ?>

        </div>
        <!-- /.row -->

        <hr>

 <?php include "components/footer.php" ?>
