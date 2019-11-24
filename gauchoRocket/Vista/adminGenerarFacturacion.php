$resultado = mysqli_query($conexion, $query);

while($usuario = mysqli_fetch_assoc($resultado)){
                    echo '
                        <tr>
                            <td><i class="fas fa-user"></i> '.$usuario["nombre"].' '.$usuario["apellido"].'</td>
                                <td>'.$usuario["user"].'</td>';
                                if ($usuario["estado"] == true){
                                    echo '<td><span class="badge badge-boxed badge-soft-primary">Activo</span></td>';
                                }else{
                                    echo '<td><span class="badge badge-boxed badge-soft-warning">Inactivo</span></td>';
                                }
                                
                                if ($usuario["medico"] == true){
                                    echo '
                                        <td>Si</td>
                                        <td>'.$usuario["nivel"].'</td>';
                                }else{
                                    echo '
                                        <td>No</td>
                                        <td>-</td>';
                                }
                            echo "
                                <td>
                                    <form action='adminFacturaAGenerar.php' method='post'>
                                        <input type='hidden' name='cliente' value='".$usuario["user"]."'>
                                        <div class='container'>
                                            <div class='row align-items-start'>";
                                            if($usuario["estado"] == true){
                                                echo "<button type='submit' name='clienteEncontrado' class='col btn btn-primary'>
                                                        Seleccionar
                                                      </button>";
                                            }else{
                                                echo "<button type='submit' name='clienteEncontrado' class='col btn btn-primary' disabled>
                                                        Seleccionar
                                                      </button>";
                                            }
                                      echo "</div>
                                        </div>
                                    </form>
                                </td>";
                }
                
                echo '
                    </tr>
                    </tbody>
                    </table>
                    </div>
                        <!--end table-responsive-->
                    </div>
                    </div>
                    </div>
                    </div>';
                    
            
?>
