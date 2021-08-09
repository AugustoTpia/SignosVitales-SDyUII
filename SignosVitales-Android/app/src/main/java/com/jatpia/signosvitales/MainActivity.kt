package com.jatpia.signosvitales

import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import com.ingenieriajhr.variasactivitys.BluetoothJhr
import kotlinx.android.synthetic.main.activity_main.*


class MainActivity : AppCompatActivity() {
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        setContentView(R.layout.activity_main)

        BluetoothJhr.parameters(this,dis_list,SignosActivity::class.java,this,MainActivity::class.java)

        BluetoothJhr.onBluetooth()

        dis_list.setOnItemClickListener { parent, view, position, id ->

            BluetoothJhr.bluetoothSeleccion(position)

            true

        }

    }
}