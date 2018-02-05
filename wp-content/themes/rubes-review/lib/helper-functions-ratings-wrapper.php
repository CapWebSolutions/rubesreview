<?php 
// This is the selector with content-sidebar added
// #genesis-content > div.fl-builder-content.fl-builder-content-2258.fl-builder-template.fl-builder-layout-template > div.fl-row.fl-row-fixed-width.fl-row-bg-none.fl-node-5a692ecf23bcb > div > div > div > div.fl-col.fl-node-5a692ecf27bf3 > div > div > div > div
// #genesis-content > div.fl-builder-content.fl-builder-content-2258.fl-builder-template.fl-builder-layout-template > div.fl-row.fl-row-fixed-width.fl-row-bg-none.fl-node-5a692ecf23bcb > div > div > div > div.fl-col.fl-node-5a692ecf27bf3 > div.fl-col-content > div.fl-module > div.fl-module-content > div.fl-html > div.ratings-leftside

// this is the sidebar selector
// #genesis-content > div.fl-builder-content.fl-builder-content-2258.fl-builder-template.fl-builder-layout-template > div.fl-row.fl-row-fixed-width.fl-row-bg-none.fl-node-5a692ecf23bcb > div > div > div > div.fl-col.fl-node-5a692ecf27df6.fl-col-small

// without row module
// #genesis-content > div.ratings-content-wrapper

function rubes_open_ratings_div(){
?>
	<!-- <div class="fl-row-content-wrap rubes-ratings"> 
		<div class="fl-row-content"> 
			<div class="fl-col-group"> 
				<div class="fl-col node-left-ratings">  -->
				<div class="node-left-ratings"> 
					<!-- <div class="fl-col-content">  -->
						<div class="ratings-leftside">
							<div class="ratings-content-wrapper">
<?php 
}

function rubes_close_ratings_div(){
?>
							</div>  <!-- ratings content wrapper here -->
						</div> <!-- ratings leftside -->
<!--					</div>  col-content -->
<!-- 				</div>  col -->
				</div>  <!-- node-left-ratings -->
<?php 
}

function rubes_open_ratings_sidebar_div(){
?>
				<div class="fl-col node-right-ratings fl-col-small"> 
					<div class="fl-col-content"> 
						<div class="ratings-rightside">
							<div class="ratings-content-sidebar-wrapper">
<?php 
}

function rubes_close_ratings_sidebar_div(){
?>
							</div>  <!-- ratings content sidebar wrapper here -->
						</div> <!-- ratings rightside -->
					</div>  <!-- col-content -->
				</div>  <!-- col col-small -->
			</div> <!-- col group -->
		</div> <!-- row content -->
	</div> <!-- row content wrap -->
<?php 
}

add_shortcode('rubes_member_sidebar', 'rubes_member_sidebar_generator_func');
function rubes_member_sidebar_generator_func(){
	printf("My Sidebar Content via saved module shortcode");
	get_sidebar('logged-in-sidebar');
}