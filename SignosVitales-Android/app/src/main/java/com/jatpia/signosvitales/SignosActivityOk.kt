package com.jatpia.signosvitales

import android.graphics.Color
import android.os.Bundle
import android.util.Log
import android.widget.Button
import android.widget.EditText
import android.widget.TextView
import androidx.appcompat.app.AppCompatActivity
import com.android.volley.Request
import com.android.volley.Response
import com.android.volley.toolbox.JsonObjectRequest
import com.android.volley.toolbox.Volley
import com.ingenieriajhr.variasactivitys.BluetoothJhr
import kotlinx.android.synthetic.main.activity_signos.*
import org.json.JSONException
import org.json.JSONObject
import kotlin.concurrent.thread






class SignosActivityOk : AppCompatActivity() {


    //private lateinit var bluetoothJhr: BluetoothJhr
    var offHilo = false

    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_signos)

        //temp.tempSet(0f)

        //temp.tempMin(0f)

        //temp.tempMax(100f)

        // bluetoothJhr = BluetoothJhr(MainActivity::class.java, this)
        val consTex = findViewById<TextView>(R.id.textview_msg)
        val enviar = findViewById<Button>(R.id.enviar)
        val editor = findViewById<EditText>(R.id.con_editor)
        val textTemF = findViewById<TextView>(R.id.temFinal)

        enviar.setOnClickListener {

            BluetoothJhr.mTx("t")

            Thread.sleep(1000)

            val mensaje = BluetoothJhr.mRx()

            consTex.text = mensaje

          //  temp.tempSet(mensaje.toFloat())

            println("--------------------------- $mensaje ----------------------------")



            //consTex.text = bluetoothJhr.Rx()
        }


        var aux = "";
        var count = 1;
        thread(start = true){
            while (!offHilo){
                Thread.sleep(500L)

            }

            while (offHilo){


                BluetoothJhr.mTx("t")
                Thread.sleep(1000)
                var mensaje = BluetoothJhr.mRx()
                println("------------------------------ $mensaje ---------------------------")
                BluetoothJhr.mensajeReset()
                //mensaje = "";
                this@SignosActivityOk.runOnUiThread(java.lang.Runnable {
                    if(mensaje.isEmpty() && mensaje == null){
                        consTex.setText("Primero")
                        //mensaje = bluetoothJhr.Rx()
                    }else{
                        textTemF.setText(aux)
                        if(aux == mensaje){
                            count++
                        }else{
                            count--
                        }
                        if(count == 2){

                            consTex.setText("Listo!")
                            editor.setText(aux)
                            offHilo = false

                            val queue = Volley.newRequestQueue(this)
                            val url = "http://www.signosvit.convence.org.mx/datos.php"

                            val postData = JSONObject()
                            try {
                                postData.put("id_usuario", "2")
                                postData.put("temp", "36.7")
                                postData.put("pulso", "67")
                                postData.put("pso", "96")
                                postData.put("estatus", "3")
                            } catch (e: JSONException) {
                                e.printStackTrace()
                            }


                            val stringReq : JsonObjectRequest =
                                JsonObjectRequest(
                                    Request.Method.POST, url,
                                    postData, Response.Listener<JSONObject> {

                                    },
                                    Response.ErrorListener { error ->
                                        Log.d("API", "error => $error")
                                    }
                                )
                            queue.add(stringReq)

                        }
                        aux = mensaje

                        if(mensaje > "37.00" && mensaje <= "38.00"){
                            consTex.setTextColor(Color.YELLOW)
                        }
                        if(mensaje < "37.00"){
                            consTex.setTextColor(Color.GREEN)
                        }
                        if(mensaje > "38.00"){
                            consTex.setTextColor(Color.RED)
                        }
                        consTex.text = mensaje
                        aux = mensaje
                        //temp.tempSet(mensaje.toFloat())




                    }

                    //Thread.sleep(500)
                    //consTex.setText(mensaje+"jo")

                })

            }

        }




        /* this@SignosActivity.runOnUiThread(java.lang.Runnable {

             consTex.text = bluetoothJhr.Rx()
             //consTex.setText()
         })*/
    }


    override fun onResume() {
        super.onResume()
        offHilo = BluetoothJhr.conectaBluetooth()
    }

    override fun onPause() {
        super.onPause()
        BluetoothJhr.exitConexion()
        //bluetoothJhr.CierraConexion()
        //offHilo = false
    }


}

