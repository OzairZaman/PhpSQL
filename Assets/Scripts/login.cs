using System.Collections;
using System.Collections.Generic;
using UnityEngine;
using UnityEngine.Networking;
using UnityEngine.UI;
using TMPro; // for texmesh pro shit
using UnityEngine.SceneManagement;


public class login : MonoBehaviour
{
    [Header("Create user")]
    public Text userName;
    public Text email;
    public Text passWord;

    [Header("Login user")]
    public Text loginName;
    public Text loginPass;

    // note for textmeshPro
    TMPro.TMP_InputField textMeshProReference;

    #region Methods
    IEnumerator CreateUser(string _user, string _password, string _email)
    {
        //the url
        string createUserURL = "http://localhost/nsirpg/insertuser.php";
        WWWForm form = new WWWForm();
        form.AddField("username", _user);
        form.AddField("email", _email);
        form.AddField("password", _password);

        UnityWebRequest webRequest = UnityWebRequest.Post(createUserURL, form);

        yield return webRequest.SendWebRequest();
    }

    IEnumerator Login(string _user, string _password)
    {
        //the url
        string createUserURL = "http://localhost/nsirpg/loginuser.php";
        WWWForm form = new WWWForm();
        form.AddField("username", _user);
        
        form.AddField("password", _password);

        UnityWebRequest webRequest = UnityWebRequest.Post(createUserURL, form);

        yield return webRequest.SendWebRequest();
        Debug.Log(webRequest.downloadHandler.text);
        if (webRequest.downloadHandler.text == "1")
        {
            SceneManager.LoadScene(1);
        }
    }

    public void CreateNewuser()
    {
        StartCoroutine(CreateUser(userName.text, passWord.text, email.text));
    }

    public void LoginUser()
    {
        StartCoroutine(Login(loginName.text, loginPass.text));
    }
    #endregion

   
}
