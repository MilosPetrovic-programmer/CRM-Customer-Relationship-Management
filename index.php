<?php
include "inc/header.php";
?>
<body>
	<?php if (!isset($_SESSION['email'])) : ?>
    <div class="container">

    <div class="row">
        <div class="col-md-12">

            <h2>KORISNICI</h2>

            <table class="table tavle-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created_at</th>
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 2) : ?>
                        <th>Rola</th>
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            // Poziv funkcije i dobivanje rezultata 
                            $select_members = get_users();
                            // ispis za svakog clana
                            foreach($select_members as $member) : ?>
                        <tr>
                            <td><?php echo $member['id']; ?></td>
                            <td><?php echo $member['name']; ?></td>
                            <td><?php echo $member['username']; ?></td>
                            <td><?php echo $member['email']; ?></td>
                            <td><?php 
                            $created_at = strtotime($member['created_at']);
                            $new_date =  date("d/m/Y", $created_at);
                            echo $new_date;
                            ?></td>
                            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 2) : ?>
                            <td><?php 
                                    if ($member['is_admin'] == 1) {
                                        echo 'Admin';
                                    } elseif ($member['is_admin'] == 2) {
                                        echo 'SuperAdmin';
                                    }
                            ?></td>
                            <?php endif; ?>                            
                            
                        </tr>

                        <?php endforeach; ?>
                </tbody>
            </table>
            <h2>KOMPANIJE</h2>

            <table class="table tavle-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Logo</th>
                        <th>Address</th>
                        <th>Tax_id</th>
                        <th>Created_at</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            // Poziv funkcije i dobivanje rezultata 
                            $select_members = get_company();
                            // ispis za svakog clana
                            foreach($select_members as $member) : ?>
                        <tr>
                            <td><?php echo $member['id']; ?></td>
                            <td><?php echo $member['name']; ?></td>
                            <td><?php echo $member['email']; ?></td>
                            <td><?php 
                                    if(isset($member['logo']) && !empty($member['logo'])) {
                                        echo '<img style="width: 60px;" src="' . $member['logo'] . '">';
                                    } else {
                                        echo "No image available";
                                    }
                                ?></td>
                            <td><?php echo $member['address']; ?></td>
                            <td><?php echo $member['tax_id']; ?></td>
                            <td><?php 
                            $created_at = strtotime($member['created_at']);
                            $new_date =  date("d/m/Y", $created_at);
                            echo $new_date;
                            ?></td>
                        </tr>

                        <?php endforeach; ?>
                </tbody>
            </table>
            <h2>Klijenti</h2>

            <table class="table tavle-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company_id</th>
                        <th>Created_at</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            // Poziv funkcije i dobivanje rezultata 
                            $select_members = get_client();
                            // ispis za svakog clana
                            foreach($select_members as $member) : ?>
                        <tr>
                            <td><?php echo $member['id']; ?></td>
                            <td><?php echo $member['name']; ?></td>
                            <td><?php echo $member['email']; ?></td>
                            <td><?php echo $member['phone']; ?></td>
                            <td><?php echo $member['company_id']; ?></td>
                            <td><?php 
                            $created_at = strtotime($member['created_at']);
                            $new_date =  date("d/m/Y", $created_at);
                            echo $new_date;
                            ?></td>
                        </tr>

                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
           
    </div>

           
    </div>
	<?php else : ?>
        
	<div class="container">

    <div class="row">
        <div class="col-md-12">

            <h2>KORISNICI</h2>

            <table class="table tavle-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Created_at</th>
                        <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 2) : ?>
                        <th>Rola</th>
                        <?php endif; ?>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                        	// Poziv funkcije i dobivanje rezultata 
                        	$select_members = get_users();
                    		// ispis za svakog clana
							foreach($select_members as $member) : ?>
                        <tr>
                            <td><?php echo $member['id']; ?></td>
                            <td><?php echo $member['name']; ?></td>
                            <td><?php echo $member['username']; ?></td>
                            <td><?php echo $member['email']; ?></td>
                            <td><?php 
                            $created_at = strtotime($member['created_at']);
                            $new_date =  date("d/m/Y", $created_at);
                            echo $new_date;
                            ?></td>
                            <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] == 2) : ?>
                            <td><?php 
                                    if ($member['is_admin'] == 1) {
                                        echo 'Admin';
                                    } elseif ($member['is_admin'] == 2) {
                                        echo 'SuperAdmin';
                                    }
                            ?></td>
                            <?php endif; ?>                            
                            <td>
                                <form action="delete_member.php" method="POST">
                                    <input type="hidden" name="member_id" value="<?php echo $member['id'] ?>">
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                </form>
                                <a href="edit_member.php?id=<?php echo $member['id']; ?>" class="btn btn-primary">EDIT</a>
                            </td>
                            
                        </tr>

                        <?php endforeach; ?>
                </tbody>
            </table>
            <h2>KOMPANIJE</h2>

            <table class="table tavle-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Logo</th>
                        <th>Address</th>
                        <th>Tax_id</th>
                        <th>Created_at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            // Poziv funkcije i dobivanje rezultata 
                            $select_members = get_company();
                            // ispis za svakog clana
                            foreach($select_members as $member) : ?>
                        <tr>
                            <td><?php echo $member['id']; ?></td>
                            <td><?php echo $member['name']; ?></td>
                            <td><?php echo $member['email']; ?></td>
                            <td><?php 
                                    if(isset($member['logo']) && !empty($member['logo'])) {
                                        echo '<img style="width: 60px;" src="' . $member['logo'] . '">';
                                    } else {
                                        echo "No image available";
                                    }
                                ?></td>
                            <td><?php echo $member['address']; ?></td>
                            <td><?php echo $member['tax_id']; ?></td>
                            <td><?php 
                            $created_at = strtotime($member['created_at']);
                            $new_date =  date("d/m/Y", $created_at);
                            echo $new_date;
                            ?></td>
                            <td>
                                <form action="delete_company.php" method="POST">
                                    <input type="hidden" name="member_id" value="<?php echo $member['id'] ?>">
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                </form>
                                <a href="edit_company.php?id=<?php echo $member['id']; ?>" class="btn btn-primary">EDIT</a>
                            </td>
                        </tr>

                        <?php endforeach; ?>
                </tbody>
            </table>
            <h2>Klijenti</h2>

            <table class="table tavle-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Company_id</th>
                        <th>Created_at</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                        <?php
                            // Poziv funkcije i dobivanje rezultata 
                            $select_members = get_client();
                            // ispis za svakog clana
                            foreach($select_members as $member) : ?>
                        <tr>
                            <td><?php echo $member['id']; ?></td>
                            <td><?php echo $member['name']; ?></td>
                            <td><?php echo $member['email']; ?></td>
                            <td><?php echo $member['phone']; ?></td>
                            <td><?php echo $member['company_id']; ?></td>
                            <td><?php 
                            $created_at = strtotime($member['created_at']);
                            $new_date =  date("d/m/Y", $created_at);
                            echo $new_date;
                            ?></td>
                            <td>
                                <form action="delete_client.php" method="POST">
                                    <input type="hidden" name="member_id" value="<?php echo $member['id'] ?>">
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                </form>
                                <a href="edit_client.php?id=<?php echo $member['id']; ?>" class="btn btn-primary">EDIT</a>
                            </td>
                        </tr>

                        <?php endforeach; ?>
                </tbody>
            </table>
        </div>
           
    </div>

           
    </div>
    
	<?php endif; ?>
</body>
</html>