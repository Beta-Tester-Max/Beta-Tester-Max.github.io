<?php 
$assistancetype = "Medical Assistance";
echo $documenttype1 = ($assistancetype === "Medical Assistance") ? "Medical Certificate" : "Enrollment Assessment Form";
echo $documenttype2 = ($assistancetype === "Medical Assistance") ? "Clinical Abstact" : "Certificate of Enrollment";
