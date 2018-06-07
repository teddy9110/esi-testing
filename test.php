<?php

    $imap = imap_open("{https://remote.topline.co.uk:143}INBOX", "alex.iles", "lime6666");
    $message_count = imap_num_msg($imap);
    print $message_count;
    imap_close($imap);
?>
