<?php
class USER 
{
    private $db;
 
    function __construct($DB_con)
    {
      $this->db = $DB_con;
    }

    public function login($username,$password){

      if($username != "" && $password != "") {
        try {
          $query = "SELECT * FROM users WHERE username=:username AND password=:password";
          $stmt = $this->db->prepare($query);
          $stmt->bindParam('username', $username, PDO::PARAM_STR);
          $stmt->bindValue('password', $password, PDO::PARAM_STR);
          $stmt->execute();
          $count = $stmt->rowCount();
          $row   = $stmt->fetch(PDO::FETCH_ASSOC);

          if($count = 1 && !empty($row)) {

            $_SESSION['sess_user_id']   = $row['user_id'];
            $_SESSION['sess_user_name'] = $row['username'];
            $_SESSION['sess_first_name'] = $row['first_name'];
            $_SESSION['sess_last_name'] = $row['last_name'];
            $_SESSION['sess_skype'] = $row['skype'];
            $_SESSION['sess_user_status'] = $row['status'];
            
          } else {
            $_SESSION['error_msg'] = "Pogresan username ili password!";
          }
        } 
        catch (PDOException $e) {
          echo "Error : ".$e->getMessage();
        }
          header('location:index.php');
      }
    }
 
   public function is_loggedin()
   {
      if(isset($_SESSION['sess_user_id']))
      {
         return true;
      }
   }

    public function register($username,$password,$email,$first_name,$last_name,$skype,$team,$status){

      /*Porvera da li vec postoji isti suername ili password u bazi*/
      try {
        $query = "SELECT * FROM users WHERE username=:username OR email=:email";
        $stmt = $this->db->prepare($query);
        $stmt->bindparam('username', $username, PDO::PARAM_STR);
        $stmt->bindparam('email', $email, PDO::PARAM_STR);

        $stmt->execute();
        $count = $stmt->rowCount();
        $row   = $stmt->fetch(PDO::FETCH_ASSOC);

        if($count == 0) {

          /*Ukoliko su username i email jedinstveni vrsi se registracija usera sa statusom 0*/
          try{
            $stmt = $this->db->prepare("INSERT INTO users (username,password,email,first_name,last_name,skype,team,status) VALUES(:username, :password, :email, :first_name, :last_name, :skype, :team, :status)");
              
            $stmt->bindparam(":username", $username);
            $stmt->bindparam(":password", $password);
            $stmt->bindparam(":email", $email);   
            $stmt->bindparam(":first_name", $first_name); 
            $stmt->bindparam(":last_name", $last_name);
            $stmt->bindparam(":skype", $skype);
            $stmt->bindparam(":team", $team);
            $stmt->bindparam(":status", $status);  

            if($stmt->execute()){
              $body_message = "<h1>Executive Digital Tool App</h1>. <br><br>Hi ".$first_name." ".$last_name. "<br><br>To complete the registration, you need to verify by clicking on <a href='".ROOT_PATH."/register.php?email=".$email."&pw=".$password."'>link</a><br>Your username: ".$username."<br><br> If you have not started this registration, ignore this email.<br><br><br><a href='https://executive-digital.com' style='text-decoration:none; color:red;'>Executive Digital</a>";
              $subject = "User Registration";
              $this->sned_mail_now($email,$username,$subject,$body_message);
            } 

            if($this->is_loggedin()!="" && $statusUser > 2){
              $this->login($username,$password);
            }
            else{
              header('location:index.php');
            }
          }
          catch(PDOException $e){
             echo $e->getMessage();
          }    
         
        } 
        else {
          if($row['username'] != ""){
            $_SESSION['error_msg'] = "Username '" . $row['username'] . "' je zauzeto";
          }
          if($row['email'] != ""){
            $_SESSION['error_msg'] = "Email '" . $row['email'] . "' je zauzet";
          }
        }
      }
      catch(PDOException $e){
        echo $e->getMessage();
      }   
    }
 
    
 
   public function redirect($url)
   {
       header("Location: $url");
   }
 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['sess_user_id']);
        header("location: index.php");
        return true;
   }

   public function sned_mail_now($send_to,$recipient,$subject,$body_message){

      //Include required phpmailer files
      require 'PHPMailer.php';
      require 'SMTP.php';
      require 'Exception.php';  

      // Define name spaces
/*      use PHPMailer\PHPMailer\PHPMailer;
      use PHPMailer\PHPMailer\SMTP;
      use PHPMailer\PHPMailer\Exception;
*/
      //sender information
      $sender = "info@petarcvetic.com";
      $email_password = "Pep@9917";


      //Create instance of phpmailer
      //$mail = new PHPMailer();
      $mail = new PHPMailer\PHPMailer\PHPMailer();

      $mail->SMTPDebug = 0;              // Enable verbose debug output

      $mail->isSMTP();                   // Set mailer to use SMTP
      $mail->Host = HOST;    // Specify main and backup SMTP servers
      $mail->SMTPAuth = AUTH;          // Enable SMTP authentication
      $mail->SMTPSecure = SSL;         // Enable TLS encryption, `ssl` 
      $mail->Port = PORT;               // TCP port to connect to
      $mail->Username = EMAIL;         // SMTP username
      $mail->Password = PASS; // SMTP password

    //  $mail->Subject = $subject;
      $mail->Subject = $subject;

      $mail->setFrom(EMAIL, 'Executive Digital - Internal Tools');
      $mail->Body = $body_message;             //Email body
      $mail->addAddress($send_to, $recipient); // Add a recipient
      $mail->addAddress('');                   // Name is optional
      $mail->addReplyTo(EMAIL);
      //      $mail->addCC('cc@example.com');
      //      $mail->addBCC('bcc@example.com');

      //      $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
      //      $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
      $mail->isHTML(true);                                  // Set email format to HTML


      if(!$mail->send()) {
        echo 'Message could not be sent.';
        echo 'Mailer Error: ' . $mail->ErrorInfo;
      } else {
        echo 'Message has been sent';
      }
        
      $mail->smtpClose();    //Closing SMTP connection
   }
}
?>
 
