<style>
    .card {
    min-width: initial;
    max-width: initial;
    border: initial;
    background: #fff0;
    float: left;
    width: 14%;
    padding: 0.7em 0.5em 1em;
}
input[type=checkbox], input[type=radio]{
    visibility:hidden;
}
.card {
  --background: #fff;
  --background-checkbox: #0082ff;
  --background-image: #fff, rgba(0, 107, 175, 0.2);
  --text-color: #666;
  --text-headline: #000;
  --card-shadow: #0082ff;
  --card-height: 190px;
  --card-width: 190px;
  --card-radius: 12px;
  --header-height: 47px;
  --blend-mode: overlay;
  --transition: 0.15s;
  user-select: none;
}
.card:nth-child(odd) .card__body-cover-image {
  --x-y1: 100% 90%;
  --x-y2: 67% 83%;
  --x-y3: 33% 90%;
  --x-y4: 0% 85%;
}
.card:nth-child(even) .card__body-cover-image {
  --x-y1: 100% 85%;
  --x-y2: 73% 93%;
  --x-y3: 25% 85%;
  --x-y4: 0% 90%;
}
.card__input {
  position: absolute;
  display: block;
  outline: none;
  border: none;
  background: none;
  padding: 0;
  margin: 0;
  -webkit-appearance: none;
}
.card__input:checked ~ .card__body {
  --shadow: 0 0 0 3px var(--card-shadow);
}
.card__input:checked ~ .card__body .card__body-cover-checkbox {
  --check-bg: var(--background-checkbox);
  --check-border: #fff;
  --check-scale: 1;
  --check-opacity: 1;
}
.card__input:checked ~ .card__body .card__body-cover-checkbox--svg {
  --stroke-color: #fff;
  --stroke-dashoffset: 0;
}
.card__input:checked ~ .card__body .card__body-cover:after {
  --opacity-bg: 0;
}
.card__input:checked ~ .card__body .card__body-cover-image {
  --filter-bg: grayscale(0);
}
.card__input:disabled ~ .card__body {
  opacity: 0.5;
}
.card__input:disabled ~ .card__body:active {
  --scale: 1;
}
.card__body {
  display: grid;
  grid-auto-rows: calc(var(--card-height) - var(--header-height)) auto;
  background: var(--background);
  height: var(--card-height);
  width: var(--card-width);
  border-radius: var(--card-radius);
  overflow: hidden;
  position: relative;
  box-shadow: var(--shadow, 0 4px 4px 0 rgba(0, 0, 0, 0.02));
  transition: transform var(--transition), box-shadow var(--transition);
  transform: scale(var(--scale, 1)) translateZ(0);
}
.card__body:active {
  --scale: 0.96;
}
.card__body-cover {
  --c-border: var(--card-radius) var(--card-radius) 0 0;
  --c-width: 100%;
  --c-height: 100%;
  position: relative;
  overflow: hidden;
}
.card__body-cover:after {
  content: "";
  position: absolute;
  left: 0;
  top: 0;
  width: var(--c-width);
  height: var(--c-height);
  border-radius: var(--c-border);
  background: linear-gradient(to bottom right, var(--background-image));
  mix-blend-mode: var(--blend-mode);
  opacity: var(--opacity-bg, 1);
  transition: opacity var(--transition) linear;
}
.card__body-cover-image {
  width: var(--c-width);
  height: var(--c-height);
  object-fit: cover;
  border-radius: var(--c-border);
  filter: var(--filter-bg, grayscale(1));
  clip-path: polygon(0% 0%, 100% 0%, var(--x-y1, 100% 90%), var(--x-y2, 67% 83%), var(--x-y3, 33% 90%), var(--x-y4, 0% 85%));
}
.card__body-cover-checkbox {
  background: var(--check-bg, var(--background-checkbox));
  border: 2px solid var(--check-border, #fff);
  position: absolute;
  right: 10px;
  top: 10px;
  z-index: 1;
  width: 28px;
  height: 28px;
  border-radius: 50%;
  opacity: var(--check-opacity, 0);
  transition: transform var(--transition), opacity calc(var(--transition) * 1.2) linear, -webkit-transform var(--transition) ease;
  transform: scale(var(--check-scale, 0));
}
.card__body-cover-checkbox--svg {
  width: 13px;
  height: 11px;
  display: inline-block;
  vertical-align: top;
  fill: none;
  margin: 7px 0 0 5px;
  stroke: var(--stroke-color, #fff);
  stroke-width: 2;
  stroke-linecap: round;
  stroke-linejoin: round;
  stroke-dasharray: 16px;
  stroke-dashoffset: var(--stroke-dashoffset, 16px);
  transition: stroke-dashoffset 0.4s ease var(--transition);
}
.card__body-header {
  height: var(--header-height);
  background: var(--background);
  padding: 0 10px 10px 10px;
}
.card__body-header-title {
  color: var(--text-headline);
  font-weight: 700;
  margin-bottom: 8px;
}
.card__body-header-subtitle {
  color: var(--text-color);
  font-weight: 500;
  font-size: 13px;
}
html {
  box-sizing: border-box;
  -webkit-font-smoothing: antialiased;
}
* {
  box-sizing: inherit;
}
*:after {
  box-sizing: inherit;
}
body {
  min-height: 100vh;
  display: flex;
  font-family: "Inter", Arial;
  justify-content: center;
  align-items: center;
  background: #fafafa;
  color: #000;
}
body .socials {
  position: fixed;
  display: flex;
  right: 20px;
  bottom: 20px;
}
body .socials > a {
  display: block;
  height: 28px;
  margin-left: 15px;
}
body .socials > a.dribbble img {
  height: 28px;
}
body .socials > a.twitter svg {
  width: 32px;
  height: 32px;
  fill: #1da1f2;
}
body .grid {
    width:100%;
}


</style>
<br/>
<h3>List of Editor Choise </h3><br/>
<form name=form1 method=post action=check.php>
    <div class="grid">
   <?php     $args = array(
    'role'    => 'Artist',
    'order'   => 'ASC'
);
$users = get_users( $args );
$i=0;
foreach ( $users as $user )
  {

if(get_user_meta( $user->ID, 'featur_user', true )[0]==1){
 
 ?>
      <label class="card">
        <div class="card__body" onclick='chkcontrol(1)'>
            <div class="card__body-cover"><img class="card__body-cover-image" src="<?php echo get_field("profile_image",'user_'.$user->ID);?>" /><span class="card__body-cover-checkbox"> <svg class="card__body-cover-checkbox--svg" viewBox="0 0 12 10">
                        <polyline points="1.5 6 4.5 9 10.5 1"></polyline>
                    </svg></span></div>
            <header class="card__body-header">
                <h2 class="card__body-header-title">  
                  <?php echo $user->first_name; ?></h2>
                <p class="card__body-header-subtitle"><?php echo $user->first_name; ?></p>
                <p class="card__body-header-subtitle"><?php echo $user->user_email; ?></p>
            </header>
        </div>
</label>
   <?php }} ?> 

</div>
</form>
