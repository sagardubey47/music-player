               
                        <h2>Recommended songs</h2>

                        <div class="recomendedSongs">

                            <?php
                            
                            $albumquery = mysqli_query($con, "SELECT * FROM  albums ORDER BY RAND() LIMIT 10");

                            while($row = mysqli_fetch_array($albumquery)) {
                                echo  "<div class = 'gridItem'>
                                    <span  onclick='openPage(\"".'albumId.php?id='. $row['id']."\" )' >
                                    <img src='" .$row['artworkPath'] . "'/>
                                        <h1> " . $row['title']. " </h1>
                                    
                                    </span>
                                </div>";
                            }
                            
                            ?>
                         </div>
                </div>
                