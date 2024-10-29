<?php
include 'db_connect.php'; // Ensure your database connection is included

// Fetch contact submissions from the database
$contacts = $conn->query("SELECT * FROM contact_submissions ORDER BY submission_date DESC");
?>
    <style>
        table#contact-submissions {
            width: 100%;
            border-collapse: collapse;
        }
        table#contact-submissions td, table#contact-submissions th {
            border: 1px solid;
        }
        .text-center {
            text-align: center;
        }
    </style>

<div class="container-fluid">
    
    <div class="col-lg-12">
        <div class="card">
            <div class="card_body">
                <div class="row justify-content-center pt-4">
                <h3> </h3>
                <h3> </h3>
                <h3>Support Contact Submissions</h3>
            </div>
                
                <table class="table table-bordered" id='contact-submissions'>
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Message</th>
                            <th>Submission Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if ($contacts->num_rows > 0):
                            $count = 1; // Initialize counter
                            while ($row = $contacts->fetch_array()):
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $count++ ?></td>
                            <td><?php echo htmlspecialchars($row['name']) ?></td>
                            <td><?php echo htmlspecialchars($row['email']) ?></td>
                            <td><?php echo htmlspecialchars($row['phone']) ?></td>
                            <td><?php echo htmlspecialchars($row['message']) ?></td>
                            <td><?php echo date("M d, Y H:i:s", strtotime($row['submission_date'])) ?></td>
                            <td class="text-center"> <!-- New cell for the action -->
                                <form action="delete_submission.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this submission?');">
                                    <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                        <?php 
                            endwhile;
                        else:
                        ?>
                        <tr>
                            <td class="text-center" colspan="7">No Contact Submissions.</td>
                        </tr>
                        <?php 
                        endif;
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>



<script>	
    $(document).ready(function(){
		$('table').dataTable()
	})
    </script>