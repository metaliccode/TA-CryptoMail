<?php
include('config/cek.php');
?>

<!--banner-->
<div class="banner">
    <h2>
        <a href="index.php">Home</a>
        <i class="fa fa-angle-right"></i>
        <span>Lihat Pesan Yang Terenkripsi</span>
    </h2>
</div>
<!--//banner-->
<?php
function get_mime_type(&$structure)
{
    $primary_mime_type = array("TEXT", "MULTIPART", "MESSAGE", "APPLICATION", "AUDIO", "IMAGE", "VIDEO", "OTHER");
    if ($structure->subtype) {
        return $primary_mime_type[(int) $structure->type] . '/' . $structure->subtype;
    }
    return "TEXT/PLAIN";
}
function get_part($stream, $msg_number, $mime_type, $structure = false, $part_number = false)
{
    if (!$structure) {
        $structure = imap_fetchstructure($stream, $msg_number);
    }
    if ($structure) {
        if ($mime_type == get_mime_type($structure)) {
            if (!$part_number) {
                $part_number = "1";
            }
            $text = imap_fetchbody($stream, $msg_number, $part_number);
            if ($structure->encoding == 3) {
                return imap_base64($text);
            } else if ($structure->encoding == 4) {
                return imap_qprint($text);
            } else {
                return $text;
            }
        }
        if ($structure->type == 1) /* multipart */ {
            while (list($index, $sub_structure) = each($structure->parts)) {
                if ($part_number) {
                    $prefix = $part_number . '.';
                }
                $data = get_part($stream, $msg_number, $mime_type, $sub_structure, $prefix . ($index + 1));
                if ($data) {
                    return $data;
                }
            }
        }
    }
    return false;
}

$msg_number = $_GET['msgno'];
$msg_from = $_GET['msgfrom'];
$msg_email = $_GET['msgemail'];
$msg_date = $_GET['msgdate'];
$msg_subject = $_GET['msgsubj'];
$usermail = $_SESSION['email'];
$password = $_SESSION['password'];

if (strpos($usermail, "@yahoo") == true || strpos($usermail, "@ymail") == true) {
    $hostname = '{imap.mail.yahoo.com:993/imap/ssl/novalidate-cert}INBOX';
} elseif (strpos($usermail, "@aol") == true) {
    $hostname = '{imap.aol.com:993/imap/ssl}INBOX';
} else {
    $hostname = '{imap.gmail.com:993/imap/ssl/novalidate-cert}INBOX';
}

$stream = imap_open($hostname, $usermail, $password) or die('Cannot connect to mail server: ' . imap_last_error());
$emails = imap_search($stream, 'FROM "' . $msg_email . '"  SUBJECT "' . $msg_subject . '" ');
//$unread_emails = imap_search($inbox,'UNSEEN');
/* Cek email*/
$max_emails = 16;
if ($emails) {
    $count = 1;
    rsort($emails);
    /* untuk semua email */
    foreach ($emails as $email_number) {
        /* mendapatkan spesifik email */
        $overview = imap_fetch_overview($stream, $email_number, 0);
        /* mendapatkan isi pesan*/
        $message = imap_fetchbody($stream, $email_number, 2);
        /* mendapatkan struktur email*/
        $structure = imap_fetchstructure($stream, $email_number);
        $attachments = array();
        /* jika terdapat lampiran */
        if (isset($structure->parts) && count($structure->parts)) {
            for ($i = 0; $i < count($structure->parts); $i++) {
                $attachments[$i] = array(
                    'is_attachment' => false,
                    'filename' => '',
                    'name' => '',
                    'attachment' => ''
                );
                if ($structure->parts[$i]->ifdparameters) {
                    foreach ($structure->parts[$i]->dparameters as $object) {
                        if (strtolower($object->attribute) == 'filename') {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['filename'] = $object->value;
                        }
                    }
                }
                if ($structure->parts[$i]->ifparameters) {
                    foreach ($structure->parts[$i]->parameters as $object) {
                        if (strtolower($object->attribute) == 'name') {
                            $attachments[$i]['is_attachment'] = true;
                            $attachments[$i]['name'] = $object->value;
                        }
                    }
                }
                if ($attachments[$i]['is_attachment']) {
                    $attachments[$i]['attachment'] = imap_fetchbody($stream, $email_number, $i + 1);
                    if ($structure->parts[$i]->encoding == 3) {
                        $attachments[$i]['attachment'] = base64_decode($attachments[$i]['attachment']);
                    } elseif ($structure->parts[$i]->encoding == 4) {
                        $attachments[$i]['attachment'] = quoted_printable_decode($attachments[$i]['attachment']);
                    }
                }
            }
        }

        /* iterate through each attachment and save it */
        foreach ($attachments as $attachment) {
            if ($attachment['is_attachment'] == 1) {
                $filename = $attachment['name'];
                if (empty($filename)) $filename = $attachment['filename'];
                if (empty($filename)) $filename = time() . ".dat";
                $fp = fopen("download/" . $filename, "w+");
                fwrite($fp, $attachment['attachment']);
                fclose($fp);
            }
        }
        if ($count++ >= $max_emails) break;
    }
}

$messages = get_part($stream, $msg_number, "TEXT/HTML");
if (get_magic_quotes_gpc()) {
    $msg_subject = stripslashes($msg_subject);
    $messages = stripslashes($messages);
}
?>

<div class="blank">
    <div class="blank-page">
        <div class="grid-form">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-block">
                            <div class="container">
                                <?php
                                if (isset($_POST['dekrippesan'])) {
                                    include "algo/AES.php";
                                    include "algo/huffman.php";
                                    //include "crypto/RC4.php";
                                    $start_time = microtime(true);
                                    $key = substr(md5($_POST['kunci']), 0, 16);
                                    //dekrip pesan
                                    $cc = base64_decode($messages);
                                    //dekopressi
                                    $huffman2 = new Huffman();
                                    $messages = $huffman2->decompress($cc);

                                    $loop     = (strlen($messages) % 16 == 0) ? strlen($messages) / 16 : intVal(strlen($messages) / 16) + 1;
                                    $plaintext = "";
                                    for ($i = 0; $i < $loop; $i++) {
                                        $start    = $i * 16;
                                        $cipher      = substr($messages, $start, 16);
                                        //$rc4 	    = new rc4($key);
                                        //$dekrip1  = $rc4->decrypt($cipher);
                                        $aes         = new AES($key);
                                        $dekrip2  = $aes->decrypt($cipher);
                                        $plaintext .= $dekrip2;
                                    }
                                    //dekrip attachment
                                    $file_path  = "download/$filename";
                                    $file_name  = substr($filename, 0, -4);
                                    $file_size  = filesize($file_path);
                                    //$fopen      = fopen($file_path, "rb");
                                    //$fread      = fread($fopen, $file_size);
                                    //$rc4file    = new rc4($key);
                                    //$de         = $rc4file->decrypt($fread);
                                    //fclose($fopen);
                                    //$fopen1     = fopen($file_path, "wb");
                                    //fwrite($fopen1, $de);
                                    //fclose($fopen1);
                                    $mod        = $file_size % 16;
                                    $fopen2     = fopen($file_path, "rb");
                                    $plain      = "";
                                    $cache      = "cache/$file_name";
                                    $fopen3     = fopen($cache, "wb");
                                    if ($mod == 0) {
                                        $banyak = $file_size / 16;
                                    } else {
                                        $banyak = ($file_size - $mod) / 16;
                                        $banyak = $banyak + 1;
                                    }
                                    ini_set('max_execution_time', -1);
                                    ini_set('memory_limit', -1);
                                    $aesfile    = new AES($key);
                                    for ($bawah = 0; $bawah < $banyak; $bawah++) {
                                        $data    = fread($fopen2, 16);
                                        //proses kompresi 
                                        //$huffman = new Huffman();
                                        //$decompressed1 = $huffman->decompress($data);
                                        //$kc = base64_decode($decompressed1);
                                        $plain   = $aesfile->decrypt($data);
                                        fwrite($fopen3, $plain);
                                    }
                                    $end_time = microtime(true);
                                    $waktu = round(($end_time - $start_time), 3); ?>
                                    <div id="output">
                                        <div class="col-md-12">
                                            <h2>&nbsp;&nbsp;Judul Pesan : <code><?php echo $msg_subject; ?></code></h2>
                                            <table class="table">
                                                <tr>
                                                    <td>Nama Pengirim</td>
                                                    <td>:</td>
                                                    <td><?php echo $msg_from; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Email Pengirim</td>
                                                    <td>:</td>
                                                    <td><?php echo $msg_email; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Tanggal</td>
                                                    <td>:</td>
                                                    <td><?php echo $msg_date; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Isi Pesan</td>
                                                    <td>:</td>
                                                    <td><?php echo $plaintext; ?></td>
                                                </tr>
                                                <tr>
                                                    <td>Lampiran</td>
                                                    <td>:</td>
                                                    <td><a target="_blank" class="btn btn-success" href="<?php echo $cache; ?>"><?php echo substr($filename, 0, -4); ?></a></td>
                                                </tr>
                                            </table>
                                        </div>
                                        <p>
                                            <h4>Halaman ini dieksekusi dalam waktu <?php echo $waktu ?> detik</h4>
                                        </p>
                                    </div>
                                <?php
                                }
                                if (empty($_POST)) { ?>
                                    <div class="container">
                                        <form action="" method="POST" class="form-horizontal">
                                            <div class="form-group row">
                                                <label class="col-md-2">Masukan Kunci</label>
                                                <div class="col-md-4">
                                                    <input class="form-control form-password" type="password" name="kunci" required placeholder="Contoh: kriptografi">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2"></label>
                                                <div class="col-md-4">
                                                    <input type="checkbox" class="form-checkbox"> Tampilkan Kunci
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-md-2"></label>
                                                <div class="col-md-4">
                                                    <input class='btn btn-success' type='submit' name='dekrippesan' value="Baca Pesan">
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                <?php } ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.form-checkbox').click(function() {
            if ($(this).is(':checked')) {
                $('.form-password').attr('type', 'text');
            } else {
                $('.form-password').attr('type', 'password');
            }
        });
    });
</script>