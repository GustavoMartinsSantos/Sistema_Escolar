<?php
    session_start();
    if(!isset($_SESSION['email']))
        header("Location: index.php");

    require_once("../../../ConexaoSQLServer/Connection.php");
    $conecta = Conecta();

    $query_telefone = "SELECT DDD, Telefone, Tipo
                       FROM tbl_Telefone
                       WHERE Email_Pessoa = :email";
    
    try {
        $stmt = $conecta->prepare($query_telefone);
        $stmt->bindValue(":email", $_SESSION['email']);
        $stmt->execute();

        $telefones = $stmt->fetchAll();

        if(!$stmt) {
            echo "Erro na consulta ao banco.";
            echo "<br>";
        }
    } catch(Exception $e) {
        echo "ERRO: " . $e->getMessage();
        exit;
    }

    $id_cont = 0
?>

<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <title>Meus dados</title>
        <meta charset="UTF-8">
        <link type="image/x-icon" rel="shortcut icon" href="../IMG/logo-icone.ico">
        <link rel="stylesheet" type="text/css" href="../CSS/index.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
        <script src="../JS/Validacao_Form.js"></script>
        <script src="../JS/Mascaras_Campos.js"></script>
    </head>
    <body>
        <header>
            <div id="logo"><a href="Principal.php">Grade Yourself</a></div>
        </header>

        <div id="titulo">Editar Telefone</div>
        
        <form name="cadastro" method="POST" action="InsertTelefone.php" 
        onSubmit="return valida_form()" id="formTelefones" autocomplete="off">
                <center><table border>
                    <tr id="first">
                        <td><label class="lbltelefone">Telefone</label></td>
                        <td><label class="lbltelefone">Tipo do Telefone</label></td>
                        <td><button class="btnTelefone" id="AddTelefone">+</button></td>
                    </tr>
                    
                    <?php foreach($telefones as list ($DDD, $telefone, $tipo_telefone)) { ?>
                        <tr id='line<?php echo ++$id_cont ?>'>
                            <td>
                                <input type="text" class="inputs telefones inputTel" name="telefone[]" size="14" pattern=".{14,}"
                                value="<?php echo $DDD . $telefone ?>">
                            </td>

                            <td><select class="inputs inputTel" name="tipo_telefone[]">
                                    <option value='CEL'>Celular</option>
                                    <option <?php echo ($tipo_telefone == 'RES') ? "selected" : null ?>
                                    value='RES'>Residencial</option>
                                </select>
                            </td>

                            <td>
                                <button class="btnTelefone RmvTelefone" id="<?php echo $id_cont ?>">-</button>
                            </td>
                        </tr>
                    <?php } ?>
                </table></center>

                <span class="grupo_botoes">
                    <input type="submit" value="Salvar Alterações" id="Cadastrar">
                </span>
                    
                <script>
                    var id_cont = <?php echo $id_cont ?>;
                    $('#AddTelefone').click(function(event){
                        event.preventDefault();
                        event.stopPropagation();
                    
                        var html = '<tr id="line' + (++id_cont) + '"><td>';
                        html += '<input type="text" class="inputs telefones inputTel" name="telefone[]" size="14" pattern=".{14,}" required>';
                        html += '</td><td><select class="inputs inputTel" name="tipo_telefone[]">';
                        html +=     '<option value="CEL">Celular</option>';
                        html +=     '<option value="RES">Residencial</option>';
                        html += '</select></td>';
                        html += '<td><button class="btnTelefone RmvTelefone" id="' + id_cont + '">-</button></td></tr>';

                        $('table').append(html);
                    });
                    
                    $('table').on('click','.RmvTelefone',function(event){
                        event.preventDefault();
                        event.stopPropagation();
                        var btn_id = '#line' + $(this).attr("id");
                        $(btn_id).remove();
                    });
                </script>
            </div>
        </form>
    </body>
</html>