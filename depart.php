<?php
// file to generate insert query for mysql
$departs = [
    'Orthopedics',
    'Internal_Medicine',
    'Obstetrics_Gynecology',
    'Dermatology',
    'Pediatrics',
    'Radiology',
    'General_Surgery',
    'Ophthalmology',
    'Anesthesia',
    'Pathology',
    'ENT',
    'Dental_Care',
    'Dermatologists',
    'Endocrinologists',
    'Neurologists',
];
// (1, 'Orthopedics', '2022-10-30 18:09:46', NULL),
echo "INSERT INTO 'departments'('id','department_name','description','department_photo_path') VALUES";
for ($i=1; $i < 16; $i++) {
    echo"($i,'$departs[$i]','description for $departs[$i] Department','')".'<br>';
}
