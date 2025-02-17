<?php
 $image = get_the_post_thumbnail_url(get_the_ID(), 'medium');
 ?>
<article class="project-item">
<div class="project-card">
                <img src="<?php echo esc_url($image); ?>" alt="<?php the_title(); ?>">
                <div class="project-info">
                    <h3><?php the_title(); ?></h3>
                    <p><?php the_excerpt(); ?></p>
                    <a href="<?php the_permalink(); ?>"><?php read_more_icon(); ?></a>
                </div>
            </div>
</article>
