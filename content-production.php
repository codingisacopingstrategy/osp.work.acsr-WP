<?php
/**
 * The template for displaying a production. For now it seems it only works in single view
 * —for tag view, content.php is used
 *
 */
?>

    <article id="post-<?php the_ID(); ?>"  >
    <div class="post" <?php post_class();?>>
        <?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
        <div class="featured-post">
            <?php _e( 'Featured post', 'acsr' ); ?>
        </div>
        <?php endif; ?>
        <header class="entry-header">
            <?php the_post_thumbnail(); ?>
            <?php if ( is_single() ) : ?>
            <h1 class="entry-title"><?php the_title(); ?></h1>
            <?php else : ?>
            <h1 class="entry-title">
                <a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'acsr' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
            </h1>
            <?php /*if($audio != '') {
                   sort($audio);
                   echo "<div id='playlist' class='clip'>";
                   foreach($audio as $key => $val) {
                       $parsed = explode(' --- ', $val);
                       if (count($parsed)!=1) { // if there are several tracks
                           echo "<a class='audio' href='";
                           echo $parsed[1] . "' title='". get_the_title() ."'>" . $parsed[0];
                           echo "</a> ";
                       } else { // if there's only one track
                           echo "<a class='audio' href='";
                           echo $parsed[0] . "' data-link='".$post->ID ."' title='". get_the_title() ."'>";
                           echo "</a> ";
                       }
                    }
                    echo "</div>";
                }
                */?>
            <?php endif; // is_single() ?>
        </header><!-- .entry-header -->

        <div class="entry-content">
           <div class="entry-meta">
           <?php
            $artists = get_post_meta($post->ID, 'wpcf-artiste', false);
            if (!empty($artists)) {
                echo "<ul class='artist'>";
                foreach($artists as $key => $val) {
                    echo "<li><a href='/?s=". str_replace(" ", "+", $val)  ."'>" . $val . "</a></li>";
                }
                echo "</ul>";
            }

           acsr_post_player();
            ?>
            </div>
            <div class="prod-desc">
                <?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'acsr' ) ); ?>
            </div>
            <?php
                $equipe = get_post_meta($post->ID, 'wpcf-equipe', true);
                if($equipe != '') echo "<p class='equipe'>" . $equipe . "</p>";
            ?>
            <div class="more-details">
                    <?php
                        $prix = get_post_meta($post->ID, 'wpcf-prix', true);
                        if($prix != '') echo " <p>Prix&thinsp;:&nbsp;" . $prix . "</p>";

                        $producteur = get_post_meta($post->ID, 'wpcf-production', true);
                        if($producteur != '') echo "<p>Production&thinsp;:&nbsp;" . $producteur . "</p>";

                        $licence = get_post_meta($post->ID, 'wpcf-licence', true);
                        if($licence != '') echo "<p>Licence&thinsp;:&nbsp;" . $licence . "</p>";
                    ?>
            </div>
        </div><!-- .entry-content -->
    </div>

    <?php if ( !is_search() ) : // In Search results, don’t display all that metadata ?>
        <?php $dates = get_post_meta($post->ID, 'wpcf-dates-de-diffusion', true);
              if($dates != ''):
        ?>
        <div class="post diffusions">
                <h3>Diffusions/Séances d'écoute</h3>
                <div class='dates'>
                    <?php echo str_replace("\n", "<br />", $dates); ?>
                </div>
        </div>

        <?php $bio = get_post_meta($post->ID, 'wpcf-bio', true);
            if($bio != ''):
        ?>
        <div class="post">
                <?php
                    if($bio != '') echo "<p class='bio'>" . $bio . "</p>";
                ?>
        </div>
            <?php endif; ?>

                    <?php
                       global $post;
            if(has_tag()):
        ?>
        <div class="post">
                <?php
                    $tag_listB =  get_the_tag_list( '<strong>Tags :</strong> ', ', ' );
                    if($tag_listB != '') echo $tag_listB;
                    echo " ";
                ?>
        </div>
        <?php endif; ?>


<?php endif; ?>
    <?php endif; ?>
    </article><!-- #post -->
