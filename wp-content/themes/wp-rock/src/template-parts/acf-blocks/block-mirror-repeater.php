<?php

/**
 * Block - Mirror repeater.
 *
 * @package WP-rock
 * @since   4.4.0
 */
$fields = get_fields();
$colors_select = get_field_value($fields, 'colors_select');
$top_description = get_field_value($fields, 'top_description');
$mirror_items = get_field_value($fields, 'mirror_items');

$colors_select = !empty($colors_select) ? $colors_select : '#7E97A6';

?>
<div class="mirror-repeater" style="background-color: <?php echo $colors_select; ?>;">
    <div class="custom-container mirror-repeater__custom-container">
        <?php
        if (!empty($top_description)) {
            echo '<p class="mirror-repeater__top-description">
                    ' . do_shortcode($top_description) .
                '</p>';
        }
        ?>
        <?php if (!empty($mirror_items)) : ?>
            <div class="mirror-repeater__container">
                <?php foreach ($mirror_items as $key => $item) :
                    $reverse_class = $key % 2 ? 'reverse' : '';
                    $hide_class = $key > 1 ? 'hide' : '';
                ?>
                    <div class="mirror-repeater__item js-mirror-item
                        <?php echo $reverse_class . ' ' .$hide_class ?>">
                        <?php
                        if (!empty($item['image'])) {
                            echo '<figure class="mirror-repeater__item-image">
                                    <img src="' . $item['image'] . '" alt="image">
                                </figure>';
                        }
                        ?>
                        <div class="mirror-repeater__item-inner">
                            <?php
                            if (!empty($item['title'])) {
                                echo '<h4 class="mirror-repeater__item-title">
                                          ' . do_shortcode($item['title']) . '
                                        </h4>';
                            }
                            if (!empty($item['description'])) {
                                echo '<p class="mirror-repeater__item-description">
                                            ' . do_shortcode($item['description']) . '
                                        </p>';
                            }

                            $link_url = isset($item['link']['url']) ? $item['link']['url'] : null;
                            $link_title = isset($item['link']['title']) ? $item['link']['title'] : null;

                            if ($link_url && $link_title) {
                                echo ' <a href="' . $link_url . '" class="mirror-repeater__item-link">
                                            ' . $link_title . '
                                        </a>';
                            }
                            ?>
                        </div>
                    </div>
                <?php endforeach; ?>
                <button class="mirror-repeater__load-more js-load-more">
                    <span>LOAD MORE</span>
                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="31" viewBox="0 0 30 31" fill="none">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M20.3532 15.9582L20.3491 15.9623L16.0036 20.3078V8.30997C16.0036 7.8328 15.6271 7.45629 15.15 7.45629C14.6729 7.45629 14.2964 7.83283 14.2964 8.30997V20.3078L9.95093 15.9623C9.60893 15.6203 9.0781 15.6262 8.74942 15.9582L8.74535 15.9623C8.40335 16.3043 8.40925 16.8352 8.74125 17.1639L8.74535 17.1679L15.15 23.5727L21.5547 17.1679L22.3678 17.9811L15.5602 24.7889C15.3393 25.0176 14.9686 25.0176 14.7398 24.7889L7.93217 17.9811C7.14334 17.2002 7.14334 15.9379 7.93217 15.1491C8.71312 14.3603 9.97527 14.3603 10.7641 15.1491L13.1464 17.5314V8.30997C13.1464 7.19771 14.0378 6.30629 15.15 6.30629C16.2623 6.30629 17.1536 7.19771 17.1536 8.30997V17.5314L19.5359 15.1491C20.3169 14.3603 21.579 14.3603 22.3678 15.1491C22.7602 15.5415 22.9574 16.051 22.9594 16.5612C22.9594 16.5638 22.9594 16.5664 22.9594 16.5691V16.5612C22.9594 16.5638 22.9594 16.5664 22.9594 16.5691C22.9574 17.0792 22.7602 17.5887 22.3678 17.9811L21.5547 17.1679C21.7263 16.9963 21.8085 16.7802 21.8094 16.5651C21.8085 16.35 21.7263 16.1339 21.5547 15.9623C21.2127 15.6203 20.6819 15.6262 20.3532 15.9582ZM26.2545 26.1279C23.939 28.6537 20.2957 29.7883 15.15 29.7883C10.0044 29.7883 6.36099 28.6537 4.04549 26.1279C1.75006 23.624 1 20.0072 1 15.6383C1 11.2693 1.75006 7.65252 4.04549 5.14863C6.36099 2.62284 10.0044 1.48828 15.15 1.48828C20.2957 1.48828 23.939 2.62284 26.2545 5.14863C28.55 7.65252 29.3 11.2693 29.3 15.6383C29.3 20.0072 28.55 23.624 26.2545 26.1279ZM15.15 28.6383C25.1682 28.6383 28.15 24.205 28.15 15.6383C28.15 7.07152 25.1682 2.63828 15.15 2.63828C5.13183 2.63828 2.15 7.07152 2.15 15.6383C2.15 24.205 5.13183 28.6383 15.15 28.6383Z" fill="#F3F0EC" />
                    </svg>
                </button>
            </div>
        <?php endif; ?>
    </div>
</div>
