<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title><?= $header["title"] ?></title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- CSS -->
        <link href="<?= $theme_folder_url ?>/bootstrap/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= $theme_folder_url ?>/plugins/colorpicker/css/colorpicker.css" rel="stylesheet">
        <!-- JS -->
        <script src="<?= $theme_folder_url ?>/bootstrap/js/jquery.min.js"></script>
        <style type="text/css">

            /* Sticky footer styles
            -------------------------------------------------- */

            html,
            body {
                height: 100%;
                /* The html and body elements cannot have any padding or margin. */
            }

            /* Wrapper for page content to push down footer */
            #wrap {
                min-height: 100%;
                height: auto !important;
                height: 100%;
                /* Negative indent footer by it's height */
                margin: 0 auto -60px;
            }

            /* Set the fixed height of the footer here */
            #push,
            #footer {
                height: 60px;
            }
            #footer {
                background-color: #f5f5f5;
            }

            /* Lastly, apply responsive CSS fixes as necessary */
            @media (max-width: 767px) {
                #footer {
                    margin-left: -20px;
                    margin-right: -20px;
                    padding-left: 20px;
                    padding-right: 20px;
                }
            }



            /* Custom page CSS
            -------------------------------------------------- */
            /* Not required for template or sticky footer method. */

            .container {
                width: auto;
                max-width: 680px;
            }
            .container .credit {
                margin: 20px 0;
            }
            .control-label {
                padding-top: 0px !important;
            }
        </style>
        <link href="<?= $theme_folder_url ?>/bootstrap/css/bootstrap-responsive.css" rel="stylesheet">
    </head>

    <body>


        <!-- Part 1: Wrap all page content here -->
        <div id="wrap">

            <!-- Begin page content -->
            <div class="container">
                <div class="page-header">
                    <h1><?= $header["title"] ?></h1>
                </div>
                <p class="lead"><?= $header["description"] ?></p>
                <? if ($info_msg != ""): ?>
                    <div class="alert alert-success">
                        <button type="button" class="close" data-dismiss="alert">&times;</button>
                        <strong>Info</strong>
                        <?= $info_msg ?>
                    </div>
                <? endif; ?>
                <hr/>
                <form method="POST" class="form-horizontal">
                    <input type="hidden" name="pwd" value="<?= $password ?>"/>
                    <? foreach ($data["fields"] as $name => $config_arr): ?>

                        <div class="control-group">
                            <label class="control-label" for="_<?= $name ?>"><?= $config_arr["title"] ?></label>
                            <div class="controls">
                                <?
                                $config_arr["id"] = '_' . $name;
                                tpl_input('_' . $name, $config_arr)
                                ?>
                            </div>
                        </div>
                    <? endforeach; ?>
                    <div style="text-align: center">
                        <button class="btn" type="submit" name="submit">Submit</button>
                    </div>
                </form>
            </div>

            <div id="push"></div>
            <?= footer() ?>
        </div>


        <!-- Le javascript
        ================================================== -->
        <!-- Placed at the end of the document so the pages load faster -->
        <script src="<?= $theme_folder_url ?>/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?= $theme_folder_url ?>/plugins/colorpicker/js/bootstrap-colorpicker.js"></script>

    </body>
</html>
