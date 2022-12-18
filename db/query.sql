-- donate.php
INSERT INTO
  `blood_bag` (
    `blood_group`,
    `date_collected`,
    `available`,
    `donar_id`,
    `blood_bank_name`
  )
VALUES
  (
    '$blood_group',
    '$date_picked',
    '1',
    '$id',
    'Blood Bank Name'
  );

-- update user last_donated
UPDATE `user` SET `last_donated` = '$date_picked' WHERE id = $id;
query

-- insert 
INSERT INTO `search` ( `content`, `blood_group`, `search_status`, `request_by`) VALUES ( '[value-1]', '[value-2]', '[value-3]', '[value-4]');
UPDATE `search` SET `search_status` = '1', `resolve_time` = '$resolve_time', `resolve_by` = '$user_id' WHERE id = $sid;
