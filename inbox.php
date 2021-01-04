<link rel="stylesheet" type="text/css" href="Asset/datatabel/jquery.dataTables.min.css">
<script src="Asset/datatabel/jquery.dataTables.min.js"></script>

<?php
include('config/cek.php');
?>
<!--banner-->
<div class="banner">
    <h2>
        <a href="index.php">Home</a>
        <i class="fa fa-angle-right"></i>
        <span>Inbox</span>
    </h2>
</div>
<!--//banner-->
<div class="blank">
    <div class="blank-page">
        <div class="grid-form">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="table-responsive">
                                <table id="inbox" class="table table-stripped table-hover datatab">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Dari</th>
                                            <th>Subjek</th>
                                            <th>Tgl & Waktu</th>
                                            <th>Ukuran</th>
                                            <th>Lihat</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                        $usermail = $_SESSION['email'];
                                        $password = $_SESSION['password'];

                                        if (strpos($usermail, "@yahoo") == true || strpos($usermail, "@ymail") == true) {
                                            $hostname = '{imap.mail.yahoo.com:993/imap/ssl/novalidate-cert}INBOX';
                                        } elseif (strpos($usermail, "@aol") == true) {
                                            $hostname = '{imap.aol.com:993/imap/ssl}INBOX';
                                        } else {
                                            $hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
                                        }
                                        $mbox = imap_open($hostname, $usermail, $password) or die('Cannot connect to mail server: ' . imap_last_error());
                                        //$status = imap_status($mbox, $hostname, SA_ALL);
                                        /*if ($status->unseen) {
                                            echo "Messages: " . $status->messages . "\n";
                                            echo "Recent: " . $status->recent . "\n";
                                            echo "Unseen: " . $status->unseen . "\n";
                                            echo "UIDnext: " . $status->uidnext . "\n";
                                            echo "UIDvalidity:" . $status->uidvalidity . "\n";
                                        } else {
                                            echo "imap_status failed: " . imap_last_error() . "\n";
                                        }*/
                                        //$c = $status->unseen;
                                        $MC = imap_check($mbox);
                                        $MN = $MC->Nmsgs;
                                        //$MN = imap_search($cc, 'UNSEEN');
                                        //filter pesan
                                        $show = 16;
                                        if ($MN <= $show) {
                                            $overview = imap_fetch_overview($mbox, "1:$MN", 0);
                                        } else {
                                            $overview = imap_fetch_overview($mbox, ($MN - $show + 1) . ":" . $MN);
                                        }
                                        //lihat semua
                                        //$overview = imap_fetch_overview($mbox, "1:$MN", 0);
                                        $size = sizeof($overview);
                                        echo "";
                                        //$no=0;
                                        for ($i = $size - 1; $i >= 0; $i--) {
                                            $val = $overview[$i];
                                            $msg = $val->msgno;
                                            //unread pesan
                                            //$headers = imap_headerinfo($mbox, $msg);
                                            //if ($headers->Unseen == 'U' || $headers->Recent == 'R') {

                                            $date = date('Y-m-d H:i:s', strtotime($val->date));
                                            $subj = isset($val->subject) ? $val->subject : "(no subject)";
                                            $header = imap_header($mbox, $msg);
                                            $from = $header->from;
                                            $email_size = $val->size;
                                            $size2 = number_format($email_size / 1024);
                                            foreach ($from as $id => $object) {
                                                $fromname = isset($object->personal) ? $object->personal : $object->mailbox;
                                                $fromaddress = $object->mailbox . "@" . $object->host;
                                            } //$no++;
                                            ?>
                                            <tr>
                                                <td> <?php echo $msg; ?> </td>
                                                <td> <?php echo $fromaddress; ?> </td>
                                                <td> <?php echo substr($subj, 0, 15) . "..."; ?> </td>
                                                <td> <?php echo $date; ?> </td>

                                                <td> <?php echo $size2; ?> KB</td>
                                                <td> <a class="btn btn-success btn-sm" href="index.php?page=viewmail&msgno=<?php echo $msg; ?>&msgdate=<?php echo $date; ?>&msgfrom=<?php echo $fromname; ?>&msgemail=<?php echo $fromaddress ?>&msgsubj=<?php echo $subj ?>">Lihat Pesan</a> </td>
                                            </tr>
                                        <?php }
                                        //}

                                        imap_close($c); ?>
                                    </tbody>
                                </table>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--<script type="text/javascript">
    $(document).ready(function() {
        $('#inbox').DataTable({
            "order": [
                [0, "desc"]
            ]
        });
    });
</script>-->

<script>
    $(document).ready(function() {
        $('#inbox').DataTable({
            "order": [
                [0, "desc"]
            ]
        });
    });
</script>

<script type="text/javascript">
    $('.email').click(ajaxDemo);

    function ajaxDemo() {
        var url = "viewmail.php?msgno=<?php echo $msg; ?>&msgdate=<?php echo $date; ?>&msgfrom=<?php echo $fromname; ?>&msgemail=<?php echo $fromaddress ?>&msgsubj=<?php echo $subj ?>";
        eModal.ajax(url);
    }
</script>