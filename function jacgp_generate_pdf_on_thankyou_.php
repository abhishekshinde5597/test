<?php
function jacgp_generate_pdf_on_thankyou_page($order_id) {
    // Get the order
    $order = wc_get_order($order_id);

    // Include FPDF library with absolute path
    $theme_dir_path = get_theme_file_path();
    require_once $theme_dir_path . '/fpdf186/fpdf.php';

    // Create PDF object
    $pdf = new FPDF('P', 'mm', 'A3', true, 'UTF-8', false);
    $pdf->AddPage();

    // Header
    $pdf->SetFont('Arial', 'B', 16);
    $pdf->SetFillColor(150, 150, 255);
    $pdf->Cell(0, 10, 'Styled List', 0, 1, 'C', true);
    $pdf->SetFillColor(255, 255, 255);

    // Get user's first name
    $user_first_name = $order->get_billing_first_name();

    // List items with user's first name
    $listItems = [
        'Dear ' . $user_first_name . ',',
        'Thank you for choosing our store. If you have any questions, please contact us at support@example.com.'
    ];

    // Set font for the list items
    $pdf->SetFont('Arial', '', 12);

    foreach ($listItems as $item) {
        $pdf->Ln(10); // Add spacing
        $pdf->MultiCell(0, 10, utf8_decode($item), 0, 'L');
    }

    // Output the PDF content
    $pdf_content = $pdf->Output('S');

    // Output the PDF
    $pdf_filename = 'order_' . $order_id . '_receipt.pdf';
    $pdf->Output($pdf_filename, 'F'); // Save the PDF to a file

    // Send email to user
    $user_email = $order->get_billing_email();
    $subject = 'Your Order Receipt';
    $message = 'Thank you, ' . $user_first_name . ', for your order! Please find your receipt attached.';
    $headers = 'Content-Type: text/html; charset=UTF-8';

    $attachments = array(WP_CONTENT_DIR . '/uploads/csv' . $pdf_filename);

    // Attempt to send the email
    $email_sent_to_user = wp_mail($user_email, $subject, $message, $headers, $attachments);

    // Send email to admin
    $admin_email = get_option('admin_email');
    $email_sent_to_admin = wp_mail($admin_email, $subject, $message, $headers, $attachments);

    // Check if both emails were sent successfully
    if ($email_sent_to_user && $email_sent_to_admin) {
        // Emails were sent successfully
        error_log('Emails were sent successfully.');
    } else {
        // Emails failed to send
        error_log('Failed to send emails.');
    }
}
add_action('woocommerce_thankyou', 'jacgp_generate_pdf_on_thankyou_page', 10, 1);
