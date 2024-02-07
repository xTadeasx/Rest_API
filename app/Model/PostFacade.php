<?php
namespace App\Model;

use Nette;
use Nette\Utils\Json;

final class PostFacade
{
    public function __construct()
    {

    }
// Nastavení databáze.
    private function db_config()
    {
        $host = 'localhost';
        $dbname = 'web_skola';
        $username = 'root';
        $password = '';
        $database = new Nette\Database\Connection("mysql:host={$host};dbname={$dbname}", "{$username}", "{$password}");
        return $database;
    }
// Vrátí http responze
    protected function http($text){
        header($text);
        exit;
    }
// Make token a dát ho do databáze.
    private function make_token($id)
    {
        $database = $this->db_config();
        $token = sha1(rand(100000000000, 999999999999));
        $database->query('Update uzivatele SET', [
            'token' => $token,  
        ], 'WHERE id ='.$id);
        return $token;
    }
// Přihlásím se pomocí tokenu a vezmu jeho údaje
    private function get_token()
    {
        $database = $this->db_config();
        $pole = [];
        $found_in_db = [];
        foreach (getallheaders() as $name => $value) {
            $pole[$name] = $value;
        }
        $token = $pole["HTTP_AUTHORIZATION"];
        $users = $database->query("SELECT * FROM uzivatele WHERE token='{$token}'");

        foreach ($users as $user) 
        {
            array_push($found_in_db, $user);
        }
    // Pokud se řádek v databázi nenašel tak 404 
        if (count($found_in_db)==0)
        {
            $this->http("HTTP/1.1 401 Unauthorized");
        }
            
        return $found_in_db;

    }
// GET vypíše tabulku z databáze

    // VZOR: www/API/<table>(workers,uzivatele,atd.../<order_by>(id.ASC)[/<id>(1,2,3,atd...)]
	public function get_worker($table, $activate, $id)
	{
        $database = $this->db_config();
        $send_worker = [];
    //není poslané id
        if ($id == 0) 
        {
            $order_by = explode(".",$activate);
 // www/API/workers         vypíše všechno z tabulky workers s určeným order by
            if ($table == "workers")
            {
                $workers = $database->query('
                    SELECT id,name,sur_name,title,job,phone_number,email
                    FROM '.$table.' 
                    WHERE active=1
                    ORDER BY '.$order_by[0].' '.$order_by[1].'
                ');
            }
 // www/API/uzivatele       vypíše všechno z tabulky uzivatele s určeným order by
            else if ($table == "uzivatele")
            {
                $workers = $database->query('
                    SELECT id,username,name,sur_name,dostupnost,active
                    FROM '.$table.' 
                    WHERE active=1
                    ORDER BY '.$order_by[0].' '.$order_by[1].'
                ');
            }
 // www/API/clanky          vypíše všechno z tabulky clanky s určeným order by
            else if ($table == "clanky")
            {
                $workers = $database->query('
                    SELECT id,kategorie,name,sub_name,cas_konani,text,active
                    FROM '.$table.' 
                    WHERE active=1
                    ORDER BY '.$order_by[0].' '.$order_by[1].'
                ');
            }
 // www/API/kategorie       vypíše všechno z tabulky kategorie s určeným order by
            else if ($table == "kategorie")
            {
                $workers = $database->query('
                    SELECT id,name,sub_kategori_to,active
                    FROM '.$table.' 
                    WHERE active=1
                    ORDER BY '.$order_by[0].' '.$order_by[1].'
                ');
            }
 // www/API/<tabulka>       vypíše všechno z určené tabulky s určeným order by
            else 
            {
                $workers = $database->query('
                    SELECT * 
                    FROM '.$table.'
                    ORDER BY '.$order_by[0].' '.$order_by[1].'
                ');
            }
        }
    //je poslané id
        else
        {
 // www/API/workers/<id>    vypíše řádek z tabulky workers s určeným id 
            if ($table == "workers") 
            {
                $workers = $database->query('
                    SELECT id,name,sur_name,title,job,phone_number,email
                    FROM '.$table.'
                    WHERE active=1 AND id = '.$id.' 
                    ');
            }
 // www/API/uzivatele/<id>  vypíše řádek z tabulky uzivatele s určeným id 
            else if ($table == "uzivatele")
            {
                $workers = $database->query('
                    SELECT id,username,name,sur_name,dostupnost,active
                    FROM '.$table.' 
                    WHERE active=1 AND id = '.$id.' 
                    ');   
                 
            }
 // www/API/clanky/<id>     vypíše řádek z tabulky clanky s určeným id 
            else if ($table == "clanky")
            {
                $workers = $database->query('
                    SELECT id,kategorie,name,sub_name,cas_konani,text,active
                    FROM '.$table.' 
                    WHERE active=1 AND id = '.$id.' 
                    ');
            }
 // www/API/kategorie/<id>  vypíše řádek z kategorie workers s určeným id 
            else if ($table == "kategorie")
            {
                $workers = $database->query('
                    SELECT id,name,sub_kategori_to,active
                    FROM '.$table.' 
                    WHERE active=1 AND id = '.$id.' 
                    ');
            }
 // www/API/<table>/<id>    vypíše řádek z určené tabulky s určeném id 
            else 
            {
                $workers = $database->query('
                    SELECT *
                    FROM '.$table.'
                    WHERE id = '.$id.'
                    ');
            }
        }
    // Dá vypsané věci do pole s kterým se dá pracovat
        foreach ($workers as $worker) 
        {
            array_push($send_worker, $worker);
        }
    // Pokud se řádek v databázi nenašel tak 404 
        if (count($send_worker)==0)
        {
           $this->http("HTTP/1.1 404 Not Found");
        }

        return $send_worker;
	}
// POST přidá řádek do tabulky 
    public function post_table($table)
    {
        $token = $this->get_token();
        foreach($token as $user)
        {
            $user_id = $user['id'];
            $user_name = $user['name'];
            $user_sur_name = $user['sur_name'];
            $user_dostupnost = $user['dostupnost'];
            $user_token = $user['token'];
        }
        
        if($user_dostupnost == 1 || $user_dostupnost == 2 || $user_dostupnost == 3)
        {
            $database = $this->db_config();
 // -Pokud dostupnost 1 nebo 2
            if($user_dostupnost == 1 || $user_dostupnost == 2 )
            {
            // insert do workers
                if($table == "workers")
                {
                    $database->query('INSERT INTO '.$table.'', [
                        'name' => $_POST['name'],
                        'sur_name' => $_POST['sur_name'],
                        'title' => $_POST['title'],
                        'job' => $_POST['job'],
                        'phone_number' => $_POST['phone_number'],
                        'email' => $_POST['email'],
                        'created_by' => $user_id,
                        'updated_by' => $user_id,
                    ]);
                    return "Pracovník úspěšně založen";
                }
            // insert do uzivatele
                else if($table == "uzivatele")
                {
                    $database->query('INSERT INTO '.$table.'', [
                        'username' => $_POST['username'],
                        'password' => sha1($_POST['password']),
                        'name' => $_POST['name'],
                        'sur_name' => $_POST['sur_name'],
                        'dostupnost' => $_POST['dostupnost']
                    ]);
                    return "Uživatel úspěšně založen";
                }
            // insert do clanky
                else if($table == "clanky")
                {
                    $database->query('INSERT INTO '.$table.'', [
                        'kategorie' => $_POST['kategorie'],
                        'name' => $_POST['name'],
                        'sub_name' => $_POST['sub_name'],
                        'cas_konani' => $_POST['cas_konani'],
                        'text' => $_POST['text'],
                        'created_by' => $user_id,
                        'updated_by' => $user_id,
                        
                    ]);
    
                    return "Članek úspěšně založen";
                }
            // insert do images
                else if($table == "images")
                {
                    $database->query('INSERT INTO '.$table.'', [
                        'file_name' => $_POST['file_name'],
                        'created_by' => $user_id,
                        'updated_by' => $user_id,
                    ]);
                    return "Obrázek úspěšně založen";
                }
            // insert do links
                else if($table == "links")
                {
                    $database->query('INSERT INTO '.$table.'', [
                        'link_name' => $_POST['link_name'],
                        'created_by' => $user_id,
                        'updated_by' => $user_id,
                    ]);
                    return "Link úspěšně založen";
                }
            // insert do kategorie
                else if($table == "kategorie")
                {
                    $database->query('INSERT INTO '.$table.'', [
                        'name' => $_POST['name'],
                        'sub_kategori_to' => $_POST['sub_kategori_to'],
                        'created_by' => $user_id,
                        'updated_by' => $user_id,
                    ]);
                    return "Link úspěšně založen";
                }
                else
                {
                    $this->http("HTTP/1.1 404 Not Found");
                }
            }
 // -Pokud dostupnost 3
            else if($user_dostupnost == 3)
            {
                if($table == "kategorie" or $table == "uzivatele" or $table == "workers")
                {
                    $this->http("HTTP/1.1 401 Unauthorized");
                }
            // insert do clanky
                if($table == "workers")
                {
                    $this->http("HTTP/1.1 401 Unauthorized"); 
                }
                else if($table == "uzivatele")
                {
                    $this->http("HTTP/1.1 401 Unauthorized");  
                }
                else if($table == "clanky")
                {
                    $database->query('INSERT INTO '.$table.'', [
                        'kategorie' => $_POST['kategorie'],
                        'name' => $_POST['name'],
                        'sub_name' => $_POST['sub_name'],
                        'cas_konani' => $_POST['cas_konani'],
                        'text' => $_POST['text'],
                        'created_by' => $user_id,
                        'updated_by' => $user_id,
                        
                    ]);
    
                    return "Članek úspěšně založen";
                }
            // insert do images
                else if($table == "images")
                {
                    $database->query('INSERT INTO '.$table.'', [
                        'file_name' => $_POST['file_name'],
                        'created_by' => $user_id,
                        'updated_by' => $user_id,
                    ]);
                    return "Obrázek úspěšně založen";
                }
            // insert do links
                else if($table == "links")
                {
                    $database->query('INSERT INTO '.$table.'', [
                        'link_name' => $_POST['link_name'],
                        'created_by' => $user_id,
                        'updated_by' => $user_id,
                    ]);
                    return "Link úspěšně založen";
                }
                {
                    $this->http("HTTP/1.1 404 Not Found");
                }
            }
        }
    }
// POST přihlásí se do svého účtu
    public function login_users($table)
    {
        $database = $this->db_config();
        $username = $_POST['username'];
        $password = sha1($_POST['password']);
        $id = 0;
        $login = $database->query("SELECT * FROM {$table} WHERE username = '{$username}' and password = '{$password}' ");
        foreach ($login as $user) 
        {
            $id = $user["id"];
        }

        if ($id > 0)
        {
            $message = "Přihlášen";

        }
        else 
        {
            $this->http("HTTP/1.1 401 Unauthorized");
        }
        return $this->make_token($id);
    }
// PUT updatne nějakou část tabulky
    public function put_table($table, $id)
    {
        $token = $this->get_token();
        foreach($token as $user)
        {
            $user_id = $user['id'];
            $user_name = $user['name'];
            $user_sur_name = $user['sur_name'];
            $user_dostupnost = $user['dostupnost'];
            $user_token = $user['token'];
        
        }

        parse_str(file_get_contents('php://input'), $put_data);
        $database = $this->db_config();
        $datas = $database->query('SELECT * FROM '.$table.' WHERE id = '.$id);
        if($user_dostupnost == 1 || 2 || 3)
        {
 // Pokud dostupnost 1 nebo 2
            if($user_dostupnost == 1 || $user_dostupnost == 2 )
            {
            // Put do tabulky workers
                if ($table == "workers")
                {
                    foreach ($datas as $data) 
                    {
                        $name = $data["name"];
                        $sur_name = $data["sur_name"];
                        $title = $data["title"];
                        $job = $data["job"];
                        $phone_number = $data["phone_number"];
                        $email = $data["email"];
                    }
                // pokud nebyla poslaná data tak se naplní věcma z databáze 
                    if(isset($put_data['name']))
                    {
                        $name = $put_data['name'];
                    }
                    if(isset($put_data['sur_name']))
                    {
                        $sur_name = $put_data['sur_name'];
                    }
                    if(isset($put_data['title']))
                    {
                        $title = $put_data['title'];
                    }
                    if(isset($put_data['job']))
                    {
                        $job = $put_data['job'];
                    }
                    if(isset($put_data['phone_number']))
                    {
                        $phone_number = $put_data['phone_number'];
                    }
                    if(isset($put_data['email']))
                    {
                        $email = $put_data['email'];
                    }
        
                    $database->query('Update '.$table.' SET', [
                        'name' => $name,
                        'sur_name' => $sur_name,
                        'title' => $title,
                        'job' => $job,
                        'phone_number' => $phone_number,
                        'email' => $email,
                        'updated_by' => $user_id,
                        'updated_at' => date("Y-m-d H:i:s"),
        
                    ], 'WHERE id ='.$id);
                    return "Změna pracovníka provedena";
                }
            // Put do tabulky uzivatele
                if ($table == "uzivatele")
                {
                    foreach ($datas as $data) 
                    {
                        $username = $data["username"];
                        $password = $data["password"];
                        $name = $data["sur_name"];
                        $dostupnost = $data["dostupnost"];
                    }
                    // pokud nebyla poslaná data tak se naplní věcma z databáze 
                    if(isset($put_data['username']))
                    {
                        $username = $put_data['username'];
                    }
                    if(isset($put_data['password']))
                    {
                        $password = $put_data['password'];
                    }
                    if(isset($put_data['name']))
                    {
                        $name = $put_data['name'];
                    }
                    if(isset($put_data['dostupnost']))
                    {
                        $dostupnost = $put_data['dostupnost'];
                    }
                    $database->query('Update '.$table.' SET', [
                        'username' => $username,
                        'password' => $password,
                        'name' => $name,
                        'dostupnost' => $dostupnost,

                    ], 'WHERE id ='.$id);
                    return "Změna uzivatele provedena";
                }
            // Put do tabulky clanky
                if ($table == "clanky")
                {
                    foreach ($datas as $data) 
                    {
                        $kategorie = $data["kategorie"];
                        $name = $data["name"];
                        $sub_name = $data["sub_name"];
                        $cas_konani = $data["cas_konani"];
                        $text= $data["text"];
                    }
                    // pokud nebyla poslaná data tak se naplní věcma z databáze 
                    if(isset($put_data['kategorie']))
                    {
                        $kategorie = $put_data['kategorie'];
                    }
                    if(isset($put_data['name']))
                    {
                        $name = $put_data['name'];
                    }
                    if(isset($put_data['sub_name']))
                    {
                        $sub_name = $put_data['sub_name'];
                    }
                    if(isset($put_data['cas_konani']))
                    {
                        $cas_konani = $put_data['cas_konani'];
                    }
                    if(isset($put_data['text']))
                    {
                        $text = $put_data['text'];
                    }
                    $database->query('Update '.$table.' SET', [
                        'kategorie' => $kategorie,
                        'name' => $name,
                        'sub_name' => $sub_name,
                        'cas_konani' => $cas_konani,
                        'text' => $text,
                        'updated_by' => $user_id,
                        'updated_at' => date("Y-m-d H:i:s"),

                    ], 'WHERE id ='.$id);
                    return "Změna clanku provedena";
                }
            // Put do tabulky images
                if ($table == "images")
                {
                    foreach ($datas as $data) 
                    {
                        $file_name = $data["file_name"];
                    }
                    // pokud nebyla poslaná data tak se naplní věcma z databáze 
                    if(isset($put_data['file_name']))
                    {
                        $file_name = $put_data['file_name'];
                    }
                    $database->query('Update '.$table.' SET', [
                        'file_name' => $file_name,
                        'updated_by' => $user_id,
                        'updated_at' => date("Y-m-d H:i:s"),

                    ], 'WHERE id ='.$id);
                    return "Změna obrázku provedena";
                }
            // Put do tabulky links
                if ($table == "links")
                {
                    foreach ($datas as $data) 
                    {
                        $link_name = $data["link_name"];
                    }
                    // pokud nebyla poslaná data tak se naplní věcma z databáze 
                    if(isset($put_data['link_name']))
                    {
                        $link_name = $put_data['link_name'];
                    }
                    $database->query('Update '.$table.' SET', [
                        'link_name' => $link_name,
                        'updated_by' => $user_id,
                        'updated_at' => date("Y-m-d H:i:s"),

                    ], 'WHERE id ='.$id);
                    return "Změna linku provedena";
                }
            // Put do tabulky kategorie
                if ($table == "kategorie")
                {
                    foreach ($datas as $data) 
                    {
                        $name = $data["name"];
                        $sub_kategori_to = $data["sub_kategori_to"];
                    }
                    // pokud nebyla poslaná data tak se naplní věcma z databáze 
                    if(isset($put_data['name']))
                    {
                        $name = $put_data['name'];
                    }
                    if(isset($put_data['sub_kategorie']))
                    {
                        $sub_kategori_to = $put_data['sub_kategori_to'];
                    }
                    $database->query('Update '.$table.' SET', [
                        'name' => $name,
                        'sub_kategori_to' => $sub_kategori_to,
                        'updated_by' => $user_id,
                        'updated_at' => date("Y-m-d H:i:s"),

                    ], 'WHERE id ='.$id);
                    return "Změna linku provedena";
                }
            }
 // Pokud dostupnost 3
            if($user_dostupnost == 3)
            {
                if($table == "kategorie" or $table == "uzivatele" or $table == "workers")
                {
                    $this->http("HTTP/1.1 401 Unauthorized");
                }
            // Put do tabulky clanky
                if ($table == "clanky")
                {
                    foreach ($datas as $data) 
                    {
                        $kategorie = $data["kategorie"];
                        $name = $data["name"];
                        $sub_name = $data["sub_name"];
                        $cas_konani = $data["cas_konani"];
                        $text= $data["text"];
                    }
                    // pokud nebyla poslaná data tak se naplní věcma z databáze 
                    if(isset($put_data['kategorie']))
                    {
                        $kategorie = $put_data['kategorie'];
                    }
                    if(isset($put_data['name']))
                    {
                        $name = $put_data['name'];
                    }
                    if(isset($put_data['sub_name']))
                    {
                        $sub_name = $put_data['sub_name'];
                    }
                    if(isset($put_data['cas_konani']))
                    {
                        $cas_konani = $put_data['cas_konani'];
                    }
                    if(isset($put_data['text']))
                    {
                        $text = $put_data['text'];
                    }
                    $database->query('Update '.$table.' SET', [
                        'kategorie' => $kategorie,
                        'name' => $name,
                        'sub_name' => $sub_name,
                        'cas_konani' => $cas_konani,
                        'text' => $text,
                        'updated_by' => $user_id,
                        'updated_at' => date("Y-m-d H:i:s"),

                    ], 'WHERE id ='.$id);
                    return "Změna clanku provedena";
                }
            // Put do tabulky images
                if ($table == "images")
                {
                    foreach ($datas as $data) 
                    {
                        $file_name = $data["file_name"];
                    }
                    // pokud nebyla poslaná data tak se naplní věcma z databáze 
                    if(isset($put_data['file_name']))
                    {
                        $file_name = $put_data['file_name'];
                    }
                    $database->query('Update '.$table.' SET', [
                        'file_name' => $file_name,
                        'updated_by' => $user_id,
                        'updated_at' => date("Y-m-d H:i:s"),

                    ], 'WHERE id ='.$id);
                    return "Změna obrázku provedena";
                }
            // Put do tabulky links
                if ($table == "links")
                {
                    foreach ($datas as $data) 
                    {
                        $link_name = $data["link_name"];
                    }
                    // pokud nebyla poslaná data tak se naplní věcma z databáze 
                    if(isset($put_data['link_name']))
                    {
                        $link_name = $put_data['link_name'];
                    }
                    $database->query('Update '.$table.' SET', [
                        'link_name' => $link_name,
                        'updated_by' => $user_id,
                        'updated_at' => date("Y-m-d H:i:s"),

                    ], 'WHERE id ='.$id);
                    return "Změna linku provedena";
                }
            }
        }
    }
// DELETE přepne aktivního pracovníka ne neaktivního
    public function delete_worker($table, $id)
	{
    // Dáme data do formátu v kterém se snima dá pracovat
        $token = $this->get_token();
        foreach($token as $user)
        {
            $user_id = $user['id'];
            $user_name = $user['name'];
            $user_sur_name = $user['sur_name'];
            $user_dostupnost = $user['dostupnost'];
            $user_token = $user['token'];
        
        }
    // Z tabulky kategorie,dostupnost,links,images se nedá mazat protože mi to dává smysl to nedovolovat
        if($table == "dostupnost" || $table == "links" || $table == "images")
        {
            $this->http("HTTP/1.1 401 Unauthorized");
        }
    // Pokud se uživatel co má právo jen na edit snaží upravit tabulku workers nebo uzivatele tak 401
        if($user_dostupnost == 3 && $table == "workers" || $user_dostupnost == 3 && $table = "uzivatele" || $user_dostupnost == 3 && $table = "kategorie")
        {
            $this->http("HTTP/1.1 401 Unauthorized");
        }
    // Uživatel deaktivuje řádek v tabulce
        if($user_dostupnost == 1 || $user_dostupnost == 2 || $user_dostupnost == 3)
        {
            $database = $this->db_config();
            $database->query('Update '.$table.' SET', [
                'active' => 0,
                'updated_by' => $user_id,
                'updated_at' => date("Y-m-d H:i:s"),
            ], 'WHERE id ='.$id);

            return "Smazáno";
        }
	}
// DELETE přepne neaktivního pracovníka na aktivního
    public function activate_worker($table, $id)
	{
        $token = $this->get_token();
        foreach($token as $user)
        {
            $user_id = $user['id'];
            $user_name = $user['name'];
            $user_sur_name = $user['sur_name'];
            $user_dostupnost = $user['dostupnost'];
            $user_token = $user['token'];
        
        }
    // Z tabulky kategorie,dostupnost,links,images se nedá mazat protože mi to dává smysl to nedovolovat
        if($table == "dostupnost" || $table == "links" || $table == "images")
        {
            $this->http("HTTP/1.1 401 Unauthorized");
        }
    // Pokud se uživatel co má právo jen na edit snaží upravit tabulku workers nebo uzivatele tak 401
        if($user_dostupnost == 3 && $table == "workers" || $user_dostupnost == 3 && $table = "uzivatele" || $user_dostupnost == 3 && $table = "kategorie")
        {
            $this->http("HTTP/1.1 401 Unauthorized");
        }
    // Uživatel deaktivuje řádek v tabulce
        if($user_dostupnost == 1 || $user_dostupnost == 2 || $user_dostupnost == 3)
        {
            parse_str(file_get_contents('php://input'), $delete_data);
            $database = $this->db_config();
        
            $database->query('Update '.$table.' SET', [
                'active' => 1,
                'updated_by' => $user_id,
                'updated_at' => date("Y-m-d H:i:s"),
            ], 'WHERE id ='.$id);
            
            return "Znovu Aktivován";
        }
	}
}
