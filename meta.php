<div class="zek_single_meta">
	<span class="author">
		<svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M2.34597 7.65497C3.61107 7.14035 4.82257 6.88304 5.98047 6.88304C7.13836 6.88304 8.33914 7.14035 9.58281 7.65497C10.8479 8.14815 11.4805 8.80214 11.4805 9.61696V11H0.480469V9.61696C0.480469 8.80214 1.1023 8.14815 2.34597 7.65497ZM7.91029 4.69591C7.37423 5.23197 6.73096 5.5 5.98047 5.5C5.22998 5.5 4.58671 5.23197 4.05064 4.69591C3.51458 4.15984 3.24655 3.51657 3.24655 2.76608C3.24655 2.01559 3.51458 1.37232 4.05064 0.836257C4.58671 0.278752 5.22998 0 5.98047 0C6.73096 0 7.37423 0.278752 7.91029 0.836257C8.44636 1.37232 8.71439 2.01559 8.71439 2.76608C8.71439 3.51657 8.44636 4.15984 7.91029 4.69591Z" fill="#C4C4C4"/>
		</svg>
		<b><?php the_author();?></b>
	</span>
	<span class="date">
		<svg width="12" height="12" viewBox="0 0 12 12" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path d="M6.30986 2.98592V6.14084L9.01408 7.74648L8.56338 8.50704L5.40845 6.59155V2.98592H6.30986ZM2.59155 9.40845C3.5493 10.3474 4.68545 10.8169 6 10.8169C7.31455 10.8169 8.44131 10.3474 9.38028 9.40845C10.338 8.4507 10.8169 7.31455 10.8169 6C10.8169 4.68545 10.338 3.55869 9.38028 2.61972C8.44131 1.66197 7.31455 1.1831 6 1.1831C4.68545 1.1831 3.5493 1.66197 2.59155 2.61972C1.65258 3.55869 1.1831 4.68545 1.1831 6C1.1831 7.31455 1.65258 8.4507 2.59155 9.40845ZM1.74648 1.77465C2.92958 0.591549 4.34742 0 6 0C7.65258 0 9.06103 0.591549 10.2254 1.77465C11.4085 2.93897 12 4.34742 12 6C12 7.65258 11.4085 9.07042 10.2254 10.2535C9.06103 11.4178 7.65258 12 6 12C4.34742 12 2.92958 11.4178 1.74648 10.2535C0.58216 9.07042 0 7.65258 0 6C0 4.34742 0.58216 2.93897 1.74648 1.77465Z" fill="#C4C4C4"/>
		</svg>
		<?php the_time('d M, Y'); ?>
	</span>
	<span class="category">
		<svg width="13" height="13" viewBox="0 0 13 13" fill="none" xmlns="http://www.w3.org/2000/svg">
		<path fill-rule="evenodd" clip-rule="evenodd" d="M0.637666 1.24112C0.266602 1.60723 0.266602 2.19649 0.266602 3.375V4.5H6.41393C6.62731 4.5 6.74651 4.49951 6.83592 4.49277C6.87576 4.48976 6.89753 4.48623 6.90869 4.48393C6.91398 4.48283 6.9168 4.48203 6.91784 4.48172L6.91912 4.48129L6.92032 4.4807C6.92128 4.48019 6.92385 4.47878 6.92839 4.47584C6.93795 4.46965 6.95593 4.45687 6.9864 4.43103C7.05478 4.37303 7.13997 4.28966 7.29186 4.1398L8.06699 3.375H8.01749C7.63653 3.375 7.44605 3.375 7.29298 3.28166C7.1399 3.18831 7.05472 3.02021 6.88435 2.68402L6.66794 2.25697C6.3272 1.58457 6.15682 1.24837 5.85068 1.06169C5.54453 0.875 5.16357 0.875 4.40165 0.875H2.80039C1.60595 0.875 1.00873 0.875 0.637666 1.24112ZM10.1967 3.38091L8.34538 5.20755L8.28904 5.26335C8.05997 5.49067 7.81276 5.73598 7.48849 5.86903C7.16421 6.00207 6.81595 6.00108 6.49323 6.00015L6.41393 6H0.266602V8.375C0.266602 10.1428 0.266602 11.0267 0.823198 11.5758C1.37979 12.125 2.27562 12.125 4.06728 12.125H9.13485C10.9265 12.125 11.8223 12.125 12.3789 11.5758C12.9355 11.0267 12.9355 10.1428 12.9355 8.37501V8.375V7.125V7.12499C12.9355 5.35723 12.9355 4.47335 12.3789 3.92417C11.9452 3.49627 11.3056 3.40178 10.1967 3.38091Z" fill="#C4C4C4"/>
		</svg>
		<?php   $categories = get_the_category(); if ( ! empty( $categories ) ) {echo '<a class="post-cat" href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';}?>
	</span>
</div>