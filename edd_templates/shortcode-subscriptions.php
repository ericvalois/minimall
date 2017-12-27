<?php
/**
 *  EDD Template File for [edd_subscriptions] shortcode
 *
 * @description: Place this template file within your theme directory under /my-theme/edd_templates/
 *
 * @copyright  : http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since      : 2.4
 */

//For logged in users only
if ( is_user_logged_in() ):

	if ( ! empty( $_GET['updated'] ) && '1' === $_GET['updated'] ) :

		?>
			<div class="edd-alert edd-alert-success">
				<?php _e( '<strong>Success:</strong> Subscription payment method updated', 'edd-recurring' ); ?>
			</div>
		<?php

	endif;

	//Get subscription
	$subscriber    = new EDD_Recurring_Subscriber( get_current_user_id(), true );
	$subscriptions = $subscriber->get_subscriptions( 0, array( 'active', 'expired', 'cancelled', 'failing', 'trialling' ) );

	if ( $subscriptions ) :
		do_action( 'edd_before_purchase_history' ); ?>

		<table id="edd_user_history" >
			<thead>
			<tr class="edd_purchase_row">
				<?php do_action( 'edd_recurring_history_header_before' ); ?>
				<th><?php _e( 'Subscription', 'edd-recurring' ); ?></th>
				<th><?php _e( 'Subscription Details', 'edd-recurring' ); ?></th>
				<?php do_action( 'edd_recurring_history_header_after' ); ?>
			</tr>
			</thead>
			<?php foreach ( $subscriptions as $subscription ) :
				$frequency    = EDD_Recurring()->get_pretty_subscription_frequency( $subscription->period );
				$renewal_date = ! empty( $subscription->expiration ) ? date_i18n( get_option( 'date_format' ), strtotime( $subscription->expiration ) ) : __( 'N/A', 'edd-recurring' );
				?>
				<tr>
					<?php do_action( 'edd_recurring_history_row_start', $subscription ); ?>
					<td class="sm-text">
						<span class="edd_subscription_name bold"><?php echo get_the_title( $subscription->product_id ); ?></span>
                        
                        <div class="actions mt1">
                            

                            <a href="<?php echo esc_url( add_query_arg( 'payment_key', edd_get_payment_key( $subscription->parent_payment_id ), edd_get_success_page_uri() ) ); ?>" class="edd_subscription_invoice"><?php _e( 'View Invoice', 'edd-recurring' ); ?></a>
                            
                            <?php if( $subscription->can_update() ) : ?>
                                &nbsp;|&nbsp;
                                <a href="<?php echo esc_url( $subscription->get_update_url() ); ?>"><?php _e( 'Update Payment', 'edd-recurring' ); ?></a>
                            <?php endif; ?>

                            <?php if( $subscription->can_renew() ) : ?>
                                &nbsp;|&nbsp;
                                <a href="<?php echo esc_url( $subscription->get_renew_url() ); ?>" class="edd_subscription_renew btn"><?php _e( 'Renew', 'edd-recurring' ); ?></a>
                            <?php endif; ?>

                            <?php if( $subscription->can_cancel() ) : ?>
                                &nbsp;|&nbsp;
                                <a href="<?php echo esc_url( $subscription->get_cancel_url() ); ?>" class="edd_subscription_cancel red"><?php _e( 'Cancel', 'edd-recurring' ); ?></a>
                            <?php endif; ?>

                            <?php if( $subscription->can_reactivate() ) : ?>
                                &nbsp;|&nbsp;
                                <a href="<?php echo esc_url( $subscription->get_reactivation_url() ); ?>" class="edd-subscription-reactivate btn"><?php _e( 'Reactivate', 'edd-recurring' ); ?></a>
                            <?php endif; ?>
                        </div>
                    </td>

					<td class="sm-text">
                        <div class="renew_date">
                            Status: <span class="edd_subscription_status"><?php echo $subscription->get_status_label(); ?></span><br>
                            Billing Cycle: <span class="edd_subscription_billing_cycle"><?php echo edd_currency_filter( edd_format_amount( $subscription->recurring_amount ), edd_get_payment_currency_code( $subscription->parent_payment_id ) ) . ' / ' . $frequency; ?></span>
                            <br>

                            <?php if( 'trialling' == $subscription->status ) : ?>
                                <?php _e( 'Trialling Until:', 'edd-recurring' ); ?>
                            <?php endif; ?>
                            Expires: <span class="edd_subscription_renewal_date"><?php echo $renewal_date; ?></span>
                            <br>

                            Initial Amount: <span class="edd_subscription_initial_amount"><?php echo edd_currency_filter( edd_format_amount( $subscription->initial_amount ), edd_get_payment_currency_code( $subscription->parent_payment_id ) ); ?></span>
                            <br>
                            Times Billed: <span class="edd_subscriptiontimes_billed"><?php echo $subscription->get_times_billed() . ' / ' . ( ( $subscription->bill_times == 0 ) ? __( 'Until cancelled', 'edd-recurring' ) : $subscription->bill_times ); ?></span>

                        </div>

						
					</td>
					<?php do_action( 'edd_recurring_history_row_end', $subscription ); ?>

				</tr>
			<?php endforeach; ?>
		</table>

		<?php do_action( 'edd_after_recurring_history' ); ?>

	<?php else : ?>

		<p class="edd-no-purchases"><?php _e( 'You have not made any subscription purchases.', 'edd-recurring' ); ?></p>

	<?php endif; //end if subscription ?>

<?php endif; //end is_user_logged_in() ?>