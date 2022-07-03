@php
                                        $a = 99;
                                        $b = 97;
                                        $c = ($a-$b)/$a;
                                        $c= $c*100;

                                        //$a = array('1,19,2,10,11');
                                        for($i = 1; $i<=100; $i++){
                                        if($i%3==0 && $i%5==0){
                                            echo 'Việt nam vô địch';
                                        }
                                        if($i%5==0){
                                            echo 'Vô địch';
                                        }elseif($i%3==0){
                                            echo 'Việt nam';
                                        
                                        }
                                        else  echo $i;
                                        }

                                        @endphp