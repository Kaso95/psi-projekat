<?php
  class Logout extends Query{
    public function query($pdo, $args){
      $sth = $pdo->prepare('
        select count(*) from User
        where nick = ?
      ');
      $sth->execute([$args->nick]);
      $num = (int)$sth->fetchColumn();

      if($num === 0){
        $pdo->prepare('
          insert into User (
            nick,
            email,
            passHash,
            isMod
          ) values (?, ?, ?, false)
        ')->execute([
          $args->nick,
          $args->email,
          $args->passHash,
        ]);

        $this->succ();
      }else{
        $this->err('nickExists');
      }
    }
  }

  new Register();
      $st = $pdo->prepare('
        select idUser from User
        where token = ?
      ');
      $st->execute([$args->token]);
      $id = $st->fetchColumn();

      if($id === false){
        $this->err('invalidToken');
        return;
      }

      $id = (int)$id;
      $pdo->prepare('
        update User
        set token = null
        where idUser = ?
      ')->execute([$id]);

      $this->succ();
    }
  }

  new Logout();
?>