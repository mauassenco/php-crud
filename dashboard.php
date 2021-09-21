<?php
    session_start();
    if(!isset($_SESSION['email']) && !isset($_SESSION['senha'])){
        header("location:index.php");
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>Dashboard</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">  
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" integrity="sha512-1ycn6IcaQQ40/MKBW2W4Rhis/DbILU74C1vSrLJxCq57o941Ym01SwNsOMqvEBFlcgUa6xLiPY/NS5R+E6ztJQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	<link rel="stylesheet" type="text/css" href="css/dashboard.css">
	
</head>
<body>
	<input type="checkbox" id="menu" name="">
	<div class="sidebar">
    
		<div class="sidebar-brand">
            <?php
        echo "<h2>Bem vindo(a) ".$_SESSION["nome"]." !</h2>";
        
           
            if($_SESSION["estalogado"]==true){
                $servername = "sql206.epizy.com";
                $username = "epiz_28882527";
                $password = "2jpstv39";
                $dbname = "epiz_28882527_projeto_bd";

                $conn = new mysqli($servername, $username, $password, $dbname);
                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                $sqlL = "SELECT * FROM usuario";
                $resultL = $conn->query($sqlL);
                while($row = $resultL->fetch_assoc()) {
                    if($row["email"]==$_SESSION["email"]){   
                        $_SESSION["nome"] = $row["nome"];                      
                        $userId = $row["id"]; 
                        $userNome = $row["nome"];                                         
                    }
                }                    
                    
            }
                
        ?> 
		</div>

		<div class="sidebar-menu">
    
			<ul>
				<li>
					<a href="" class="active"><span class="fa fa-home"></span><span>Geral</span></a>
				</li>
				<li>
					<a href=""><span class="fas fa-chalkboard-teacher"></span><span>Professor</span></a>
				</li>
				<li>
					<a href=""><span class="fa fa-user-graduate"></span><span>Aluno</span></a>
				</li>
				<li>
					<a href=""><span class="fa fa-chart-bar"></span><span>Estatisticas</span></a>
				</li>
				<li>
					<a href=""><span class="fa fa-calendar-alt"></span><span>Agendamentos</span></a>
				</li>	
				<li>
					<a href=""><span class="fa fa-file-invoice-dollar"></span><span>Fincanceiro</span></a>
				</li>
                <li>					
                    <br>
				</li>
				<li>
					<a href=""><span class="fa fa-cogs"></span><span>Configurações</span></a>
				</li>
			</ul>
		</div>
	</div>
	<div class="content">		
		<header>
			<p><label for="menu"><span class="fa fa-bars"></span></label><span class="accueil">Dashboard</span></p>
			<div class="search-wrapper">
				<span class="fa fa-search"></span>
				<input type="search" name="" placeholder="Pesquisar" />
			</div>

			<div class="user-wrapper" id="dropdown">
				<div>
                    <?php
                        echo "<h4>".$_SESSION["nome"]."</h4>"; 
                            
 
                    ?>
					<small> Professor / Aluno</small>
				</div>
				
				<img src="https://media.istockphoto.com/vectors/profile-placeholder-image-gray-silhouette-no-photo-vector-id1016744034?k=20&m=1016744034&s=170667a&w=0&h=JlerB4H3IeLolDMQOYiAF9uLuZeW0bs4jH6NdrNPDtE=" width="30" height="30" class="logo-admin">
				<div class="dropdown-content">
                    <p>Meu perfil</p>
                    <p><a class="btn-default" href="/logout.php">Logout</a></p>
				</div>
				
			</div>
		</header>

		<main>
			<div class="cards">
				<div class="card-single">
					<div>
                      <?php                      
                            $sql = "SELECT * FROM agendamento";
                            $agendamentosConfirmados = 0;
                            $agendamentosAbertos = 0;
                            $result = $conn->query($sql);                                
                            if ($result->num_rows >= 0) {
                            // output data of each row
                                while($row = $result->fetch_assoc()) {
                                        if($row["professor_id"]==$userId && $row["confirmacao_pagamento"] == 1){
                                            $agendamentosConfirmados = $agendamentosConfirmados + 1;
                                        } 
                                        if($row["professor_id"]==$userId && $row["status_agendamento"] == "aguardando aceite do professor"){
                                                $agendamentosAbertos =  $agendamentosAbertos + 1;
                                        }                                       
                                }
                            } else {
                                echo "0 resultados";
                            }
                            echo "<h2>$agendamentosConfirmados</h2>";
                            
                        ?>						
						<small>Agendamentos confirmados</small>
					</div>
					<div>
						<span class="fa fa-check-circle"></span>
					</div>
				</div>

				<div class="card-single">
					<div>
						<?php
                          echo "<h2>$agendamentosAbertos</h2>";
                        ?>
						<small>Agendamentos em aberto</small>
					</div>
					<div>
						<span class="fa fa-hourglass-half"></span>
					</div>
				</div>
				<div class="card-single">
					<div>
						<h2>4.5 / 5</h2>
						<small>Avaliação</small>
					</div>
					<div>
						<span class="fa fa-star-half-alt"></span>
					</div>
				</div>
				<div class="card-single">
					<div>
						<h2>R$ 1.543,21</h2>
						<small>Crédito</small>
					</div>
					<div>
						<span class="fa fa-dollar-sign"></span>
					</div>
				</div>
			</div>

			<div class="composant">
				<div class="ventes">
					<div class="case">
						<div class="header-case">
							<h2>Agendamentos confirmados</h2>
							<button class="button">Ver todos  <span class="fa fa-arrow-right"></span></button>
						</div>
						<div class="body-case">
							<div class="tableau">
								<table width="100%">
								  <thead>
								    <tr>
								      <td>Aluno</td>
								      <td>Data - Horário</td>
								      <td>Contato</td>
								    </tr>
								  </thead>
								  <tbody>
                                  <?php
                                        $sql3 = "SELECT agendamento.professor_id,  agendamento.data_agendamento, agendamento.horario, agendamento.aluno_id, agendamento.confirmacao_pagamento, usuario.id, usuario.nome, usuario.email
                                        FROM agendamento, usuario
                                        WHERE agendamento.aluno_id = usuario.id";
                                        $result3 = $conn->query($sql3);                                
                                        if ($result3->num_rows >= 0) {
                                        // output data of each row
                                            while($row = $result3->fetch_assoc()) {
                                                 if($row["professor_id"]==$userId && $row["confirmacao_pagamento"] == 1){
                                                    echo "<tr>
                                                            <td>". $row["nome"]."</td>
                                                            <td>". $row["data_agendamento"]." - ". $row["horario"]."</td>
                                                            <td>". $row["email"]."</td>
                                                        </tr>";   
                                                 }                                          
                                            }
                                        } else {
                                            echo "0 resultados";
                                        }
                                  ?>

								    
								  </tbody>
								</table>
							</div>
						</div>
					</div>
				</div>



				<div class="stock">
					<div class="case">
						<div class="header-case">
							<h2>Agendamentos em aberto</h2>							
						</div>
						<div class="body-case">
                        <?php
                            $sql4 = "SELECT agendamento.id as agendaId, agendamento.professor_id,  agendamento.data_agendamento, agendamento.horario, agendamento.aluno_id, agendamento.confirmacao_pagamento, agendamento.status_agendamento, usuario.id, usuario.nome, usuario.email
                            FROM agendamento, usuario
                            WHERE agendamento.aluno_id = usuario.id";
                            $result4 = $conn->query($sql4);                                
                            if ($result4->num_rows >= 0) {
                            // output data of each row
                                while($row = $result4->fetch_assoc()) {
                                        if($row["professor_id"]==$userId && $row["status_agendamento"] === "aguardando aceite do professor"){
                                        echo "<div class='all-users'>
                                                    <div class='infos'>
                                                        <img src='https://media.istockphoto.com/vectors/profile-placeholder-image-gray-silhouette-no-photo-vector-id1016744034?k=20&m=1016744034&s=170667a&w=0&h=JlerB4H3IeLolDMQOYiAF9uLuZeW0bs4jH6NdrNPDtE=' width='30' height='30'>
                                                        <div>
                                                            <h4>". $row["nome"]."</h4>
                                                            <small>". $row["data_agendamento"]." - ". $row["horario"]."</small>
                                                        </div>
                                                    </div>								
                                                    <div class='user-contact'>                                                        
                                                        <a href='confirmaUpdate.php?id=".$row["agendaId"]."'><span class='fa fa-check accept'></span></a>
                                                        <a href='confirmaDelete.php?id=".$row["agendaId"]."'><span class='fa fa-times refuse'></span></a>
                                                        <span class='fa fa-envelope email-contato'></span>
                                                    </div>
                                                </div>";                                    
                                        }                                          
                                }
                            } else {
                                echo "0 resultados";
                            }
                          
                        ?>
							
						</div>
						<button class="btn">Ver todos  <span class="fa fa-arrow-right"></span></button>
					</div>
				</div>
				
				<div class="statistique">					
				    <div class="statistique-barre bar3"></div>
					<div class="statistique-barre bar4"></div>
					<div class="statistique-barre bar5"></div>
					<div class="statistique-barre bar6"></div>
					<div class="statistique-barre bar5"></div>
					<div class="statistique-barre bar6"></div>
                    <div class="statistique-barre bar3"></div>
					<div class="statistique-barre bar4"></div>
					<div class="statistique-barre bar5"></div>
					<div class="statistique-barre bar6"></div>
					<div class="statistique-barre bar3"></div>
					<div class="statistique-barre bar4"></div>					
			</div>
				<div class="legende">
					<h4>Legenda</h4>
					<table>
						<tr>
							<td><span class="evolution color-one"></span>Agendamentos Confirmados</td>
						</tr>
						<tr>
							<td><span class="evolution color-two"></span>Total de Agendamentos</td>
						</tr>
					</table>
					<div class="txt-deco">
						<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod
						tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
						quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo
						</p>
					</div>
				</div>
			</div>


			<div class="calendar">
			<div class="mois-annee">
			  <ul>
			    <li class="prev">&#10094;</li>
			    <li class="next">&#10095;</li>
			    <li>Março<br><span>2021</span></li>
			  </ul>
			</div>

			<ul class="mois">
			  <li>Se</li>
			  <li>Te</li>
			  <li>Qa</li>
			  <li>Qi</li>
			  <li>Sx</li>
			  <li>Sa</li>
			  <li>Do</li>
			</ul>

			<ul class="jours">
			  <li>1</li>
			  <li>2</li>
			  <li>3</li>
			  <li>4</li>
			  <li>5</li>
			  <li>6</li>
			  <li>7</li>
			  <li>8</li>
			  <li>9</li>
			  <li><span class="active">10</span></li>
			  <li>11</li>
			  <li>12</li>
			  <li>13</li>
			  <li>14</li>
			  <li>15</li>
			  <li>16</li>
			  <li>17</li>
			  <li>18</li>
			  <li>19</li>
			  <li>20</li>
			  <li>21</li>
			  <li>22</li>
			  <li>23</li>
			  <li>24</li>
			  <li>25</li>
			  <li>26</li>
			  <li>27</li>
			  <li>28</li>
			  <li>29</li>
			  <li>30</li>
			  <li>31</li>
			</ul>
			</div>
		</main>
          
	</div>
     
</body>
</html>
