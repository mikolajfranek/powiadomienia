package eu.powiadomienia

import android.annotation.SuppressLint
import android.os.Bundle
import androidx.appcompat.app.AppCompatActivity
import eu.powiadomienia.databinding.ActivityMainBinding
import org.jsoup.Jsoup
import org.jsoup.nodes.Document


class MainActivity : AppCompatActivity() {

    private lateinit var bindingActivityMain: ActivityMainBinding

    @SuppressLint("SetJavaScriptEnabled")
    override fun onCreate(savedInstanceState: Bundle?) {
        super.onCreate(savedInstanceState)
        this.bindingActivityMain = ActivityMainBinding.inflate(this.layoutInflater)
        setContentView(R.layout.activity_main)
        bindingActivityMain.webview.setInitialScale(1)

        bindingActivityMain.webview.settings.javaScriptEnabled = true
        bindingActivityMain.webview.settings.userAgentString = "Apk's powiadomienia.eu"
        bindingActivityMain.webview.settings.loadWithOverviewMode = true
        bindingActivityMain.webview.settings.useWideViewPort = true



        //webView.setScrollBarStyle(WebView.SCROLLBARS_OUTSIDE_OVERLAY);
        //webView.setScrollbarFadingEnabled(false);

        //browser.getSettings().setLoadWithOverviewMode(true);
        //browser.getSettings().setUseWideViewPort(true);

        //val document: Document = Jsoup.connect("https://en.wikipedia.org/").get()


        bindingActivityMain.webview.loadUrl("https://powiadomienia.eu")

    }


}