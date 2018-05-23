<?php
require('config.php');
?><!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />

    <style type="text/css" rel="stylesheet" media="all">
        /* Media Queries */
        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
            .text-center {
                text-align: center;
            }
        }
    </style>
</head>

<body>
    <table width="100%" cellpadding="0" cellspacing="0">
        <tr>
            <td align="center">
                <table width="100%" cellpadding="0" cellspacing="0">
                    <!-- Email Body -->
                    <tr>
                        <td width="100%">
                            <table width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <!-- Greeting -->
                                        <h1>
                                            <?php echo $form_data['subject']; ?>
                                        </h1>

                                        <!-- Intro -->
                                        <?php foreach (array_diff_key($form_data, ['subject'=>0]) as $key => $line): ?>
                                            <p>
                                                <?php if($key === 'phone'): ?>
                                                    <b><?php echo $fields[$key]["title"]; ?></b>: <a href="tel:<?php echo strip_tags($line); ?>"><?php echo strip_tags($line); ?></a>
                                                <?php elseif(isset($fields[$key])): ?>
                                                    <b><?php echo $fields[$key]["title"]; ?></b>: <?php echo strip_tags($line); ?>
                                                <?php endif; ?>
                                            </p>
                                        <?php endforeach; ?>

                                        <p>
                                            <i>Sent from url: <?php echo $_SERVER['HTTP_REFERER']; ?>, ip: <?php echo $_SERVER['REMOTE_ADDR']; ?></i>
                                        </p>

                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td>
                            <table align="center" width="570" cellpadding="0" cellspacing="0">
                                <tr>
                                    <td>
                                        <p class="text-center">
                                            &copy; <?php echo date('Y'); ?>
                                            <?php echo $app_name; ?>.
                                            All rights reserved.
                                        </p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
