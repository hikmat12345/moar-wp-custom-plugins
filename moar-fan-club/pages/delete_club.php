  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/pretty-checkbox@3.0/dist/pretty-checkbox.min.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
                          <script>
								$("#submit").click(function() {
								  $("#submit").click();
								});
							</script>
<style> 
.manage__btn {
    box-sizing: border-box;
    padding: 1px !important;
}
.manage__btn button {
    padding: 3px !important;
}
  .table tr th, .table tr td {
    font-size: 1.063rem;
    padding: 5px 21px !important;
}
.moar-card {
    background-color: #c5c5c542;
    padding: 20px;
    margin: 20px 20px 20px 0px;
}
.manage__btn img {
    width: 42px;
}
	.card-body th {
    outline: 0;
    color: black;
}
	.manage__btn a{
		width:40px;
		padding:initial;
	}
	input[type=radio] {
    pointer-events: fill !important;
}
	body.competetion-list_page_sub_page_three .wp-list-table tbody#the-list tr:nth-child(odd) {
    background: #e1e1e1d1 !important;
    box-shadow: 0px 0px 9px 0px rgb(0 0 0 / 10%);
}

.tabel-view-list #the-list tr.type-artist_vote td {
    font-size: 13px !important;
}

.widefat td, .widefat th {
    font-size: 15px;
    color: black;
    line-height: 26px;
    text-align: center;
    text-transform: capitalize;
}
.state {
    margin-bottom: -6px;
}
	form .d-flex span {
    padding: 7px 0px 9px 19px !important;
    line-height: 3px !important;
    font-size: 10px !important;
}
	[type="checkbox"].filled-in:not(:checked)+span:not(.lever):after {
    height: 16px !important;
    width: 16px !important;
    background-color: transparent;
    border: 1px solid #5a5a5a !important;
    top: 0px;
    z-index: 0;
}
   .table tr th, .table tr td {
       font-size: 0.863rem;
   }
	td, textarea, input, select {
    background: initial !important;
}
	thead {
    background-color: #656565;
}
	thead th {
	color: #e7e7e7 !important;
	}    
  </style>

  <div class="wrapper ">
 
    <div class="main-panel">
      <!-- Navbar -->
    
      <!-- End Navbar -->
      <div class="content">
        <div class="container-fluid">


<!-- Only total votest listing -->
		 <div class="row">
            <div class="col-md-12">
              <div class="moar-card">
                <div class="card-header card-header-primary">
                  <h4 class="card-title ">Total Votes of Each Artists in this competition.</h4>

                </div>
                <div class="card-body">
                  <div class="table-responsive">
                     <table class="table wp-list-table widefat fixed striped table-view-list posts">
                      <thead class=" text-primary  ">
                        <th class="manage-column column-competition_number column-primary">
                          #
                        </th>
                        <th class="manage-column column-artist_name column-primary">
                          Artist Name
                        </th>
                        <th  class="manage-column column-content_name column-primary">
                         Content Name
                        </th  >
                        <th  class="manage-column column-artist_name column-primary">
                          Name of Competetion
                        </th>
                        
                        <th  class="manage-column column-total_votes column-primary">
                          Total Votes
                        </th>
					 </thead>
                      <tbody id="the-list">
       <?php
						   $getCurrentIp= do_shortcode('[show_ip]');
						  global $wpdb;
								$competetions = 
								$wpdb->get_results("SELECT * FROM `wp_uservotes` WHERE UserIP='203.175.72.33'");
								//var_dump($competetions);
						  
						  function getidOfArtistList($getArtistIdList){
								global $wpdb;
								$competetion = 
								$wpdb->get_results("SELECT * FROM `wp_uservotes` WHERE ArtistId='". $getArtistIdList."'");
								return count($competetion);
						  }
						  $i=1;
					   $args = array(  
							  'post_type' => 'competetion',
							  'post_status' => 'publish',
							  'posts_per_page' => -1, 
							  'orderby' => 'ID', 
							  'order' => 'ASC', 
						  );
						  $query = new WP_Query( $args ); ?>

							<?php if ( $query->have_posts() ) : ?>
<?php while ( $query->have_posts() ) : $query->the_post(); 
  
     ?>

						   <tr class="iedit author-other level-0 type-artist_vote post-password-required hentry">
                              <td class="entery_number column-entery_number has-row-actions column-primar">
                                <?php echo $i++; ?>
                              </td>
                              <td class="entery_number column-entery_number has-row-actions column-primar"> 
                               <?php the_author(); ?>
                              </td>
                              <td> 
                                 <?php the_title(); ?>
                              </td>
                              <td class="competition_name column-entery_number has-row-actions column-primar">
                                   <?php 
								  global $wpdb;
										$getNameOfCompetition =$wpdb->get_results("SELECT * FROM `wp_Competetion`  WHERE Id = (SELECT MAX(Id) FROM wp_Competetion)");
										$getCompetitionNameDB="";
										foreach( $getNameOfCompetition as $comp_name )
										{
											 $getCompetitionNameDB.=$comp_name->competetionName;
										}
								  echo $getCompetitionNameDB;
								  ?>
                              </td>
                              
                              <td class="w-25 total_views column-entery_number has-row-actions column-primar">
								  
                               <?php 
								echo getidOfArtistList(get_the_author_ID());
                               ?>
                              </td>
							  
                            </tr>
						  <?php
						  
						  endwhile;
						  endif;
						  ?>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
            
          </div>	
			
<!-- 			end of contents -->
        </div>
      </div>
     
    </div>
  </div>
