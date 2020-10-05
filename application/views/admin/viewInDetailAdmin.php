<style>
    .container1 {
        width: 100%;
        min-height:600px;
        justify-content: center;
        align-items: center;
        justify-content: center;
        padding: 0px;
    }

    #list {
        align-items: center;
    }

    .title {
        width: auto;
        margin: 0 auto;
    }

    .title h1 strong {
        width: auto;
        font-family: 'medium-content-title-font, Georgia, Cambria, Times New Roman, Times, serif';
        font-size: 40px;
        font-weight: inherit;
        letter-spacing: 1;
    }

    .description {
        width: auto;
        color: rgba(0, 0, 0, 0.54);
    }

    .images {
        width: 90%;
        margin: 0 auto;
    }

    .images img {
        margin: 10px auto;
        width: 100%;
        object-fit: cover;
    }

    .follow {
        align-items: center;
    }

    #follow {
        box-sizing: border-box;
        border-style: solid;
        border-width: 1px;
        border-radius: 4px;
        cursor: pointer;
        padding: 0px 8px;
        text-decoration: none;
        background: white;
        color: rgba(0, 0, 0, 0.54);
    }

    .heading,
    .short_description {
        width: 90%;
        margin: 0 auto;
        font-family: 'medium-content-title-font, Georgia, Cambria, Times New Roman, Times, serif';
        font-size: 40px;
    }

    .heading h1 strong {
        font-size: 40px;
        text-transform: capitalize;
        color: rgba(0, 0, 0, 0.84);
        font-family: 'medium-content-title-font, Georgia, Cambria, Times New Roman, Times, serif';
        margin 0;
    }

    .upper {
        width: 100%;
        margin: 0 auto;
    }

    .response {
        width: 100%;
        margin: 10px auto;
        justify-content: center;
    }

    .comment {
        width: 80%;
        margin: 10px auto;
    }
    /* .body{
        min-height:500px;
    } */
</style>

<body>
<section>
    <div class="container1" >
        <div>
            <div class="upper">
                <div class="heading">
                    <h1>
                        <strong>
                            <?php echo $blogListDetails['title']; ?>
                        </strong>
                    </h1>
                </div>
                <!-- end heading -->
                <div class="short_description">
                    <h2 class="description" style="margin-left:0%;"><?php echo $blogListDetails['detail']; ?></h2>
                    <p style="font-size:12px; font-weight:bold;"><?php echo date_format(date_create($result['date']),"M d,Y "); ?></p>
                </div>
                <div class="title" style="margin-left:5%;">
                    <li id="list" class="collection-item sidenav-trigger display-flex avatar" data-target="slide-out-chat">
                        
                        <?php if($memberName['profile_img'] == ''){?>
                            <span class="avatar-status avatar-online avatar-50">
                                <img src="<?php echo base_url(); ?>/assets/images/avatar/avatar-1.png" style = " width:50px; height:50px;"alt="avatar" />
                            </span>
                            <?php } else{?>
                            <span class="avatar-status avatar-online avatar-50">
                                <img  src="<?php echo base_url().'assets/images/users/'.$memberName['profile_img']; ?>" style = " width:50px; height:50px;" alt="avatar" />
                            </span>
                        <?php }?>

                        <div class="user-content">
                            <h2 class="line-height-0"><?php echo $memberName['username']; ?></h2>
                        </div>
                       
                    </li>
                </div>
            </div>
            <div class="images">
                <img src="<?php echo base_url().'assets/upload/'.$blogListDetails['url']; ?>" alt="something wrong in photo" style="width: 100%;">
            </div>
        </div>
        <!-- main content -->
        <div>
            <div class="title" style="margin-left:5%;  margin-right:5%;">
                <p class="description">
                    <?php echo $blogListDetails['content']; ?>
                </p>
            </div>
            <!-- end main content -->
        </div>

</section>
</body>