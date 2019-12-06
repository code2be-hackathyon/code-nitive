//STEP 1. Import required packages

import java.io.BufferedReader;
import java.sql.*;
import java.io.*;

import java.util.HashMap;
import java.util.Map;

import org.json.simple.JSONArray;
import org.json.simple.JSONObject;

/**
 * ******************************************
 *
 * @author lolo
 */
public class ImportFicGIFT {
    // La premiere question decrit le QUIZZ

    protected String flux = "";

    /**
     * ********************************************
     *
     * @return
     */
    public String getFlux() {
        return flux;
    }

    /**
     * **********************************************
     *
     * @param flux
     */
    public void setFlux(String flux) {
        this.flux = flux;
    }

    /**
     * ***************************************************
     * Extrait une question du fichier
     */
    public Map<String, String> extractQ() {
        Map<String, String> Q = new HashMap<String, String>();

         Q.put("0", "0");
        // on saute le commentaire
        int pos = flux.indexOf("::");
        if (pos > 0) {
            flux = flux.substring(pos + 2); // on saute le ::
        }
        pos = flux.indexOf("::");
        if (pos != -1) {
            // on a l'overview
            Q.put("1", flux.substring(0, pos));
            //System.out.println("Overview ! " +Q.get("1"));
            // on  decoupe
            flux = flux.substring(pos + 2);

            pos = flux.indexOf("{");
            if (pos > 0) {
                // la question proprement dite avec overview
                Q.put("2", flux.substring(0, pos));

                flux = flux.substring(pos + 1).trim();
                // on balaye le reste
                //System.out.println(flux2);

                int nb = 3; // en element associatif
                int i = 0;
                String mot = "";
                String c = flux.substring(0, 1);
                boolean bFin = false;
                while (!c.equals("") && (!bFin)) {
                    if (c.equals("~") || c.equals("=")) {
                        if (!mot.equals("")) {

                            Q.put(Integer.toString(nb), mot.trim());
                            nb = nb + 1;
                        }
                        mot = c;
                    } else {
                        if (c.equals("}")) { // fin de mot
                            Q.put(Integer.toString(nb), mot.trim());
                            nb = nb + 1;
                            Q.put("0", Integer.toString(nb)) ;
                            bFin = true;
                        } else {
                            mot = mot + c;
                        }
                    }
                    if (!bFin) {
                        i = i + 1;
                        c = flux.substring(i, i + 1);
                    }
                }
               

               
            }
        }
        return Q;

    }

    /**
     * **************************************
     * readFile
     *
     * @param fic
     * @throws FileNotFoundException
     * @throws IOException
     */
    public void readFile(String fic) throws FileNotFoundException, IOException {
        File file = new File(fic);

        BufferedReader br = new BufferedReader(new FileReader(file));

        String st;
        while ((st = br.readLine()) != null) {
            flux = flux + st;
        }
    }

    /**
     * *****************************************************************
     * /
     *
     * @return
     * @throws IOException
     */
    public static void main(String[] args) throws IOException {

        //Map<String, String> Q = Import.importQuizz();
        Connection conn = null;
        Statement stmt = null;
        try {
            //STEP 2: Register JDBC driver
            Class.forName("com.mysql.jdbc.Driver");

            //STEP 3: Open a connection
            System.out.println("Connecting to database...");
            conn = DriverManager.getConnection(DB_URL, USER, PASS);

            // decodage
            //STEP 4: Execute a query
            System.out.println("Creating statement...");
            stmt = conn.createStatement();

            /*  sql = "insert into question (id,label,reponse,quizz_id,value,order, type) "
                    + "values ('"+Q.get("1").hashCode()+"','"+ Q.get("1")
                    +"','"+Q.get("2")+"','"+Q.get("1").hashCode()+"','1','1','QCM')";

             
            String sql = "insert into question  "
                    + "values ('2569','" + Q.get("1")
                    + "','" + Q.get("2") + "','" + Q.get("1").hashCode() + "','1','1','QCM')";

            s
             */
 /*
      
      //STEP 4: Execute a query
      System.out.println("Creating statement...");
      stmt = conn.createStatement();
      String sql;
      sql = "SELECT id, first, last, age FROM Employees";
      ResultSet rs = stmt.executeQuery(sql);

      //STEP 5: Extract data from result set
      while(rs.next()){
         //Retrieve by column name
         int id  = rs.getInt("id");
         int age = rs.getInt("age");
         String first = rs.getString("first");
         String last = rs.getString("last");

         //Display values
         System.out.print("ID: " + id);
         System.out.print(", Age: " + age);
         System.out.print(", First: " + first);
         System.out.println(", Last: " + last);
      }
      //STEP 6: Clean-up environment
      rs.close();
             */
            System.out.println("Goodbye!");
        }//end main
    }//end FirstExample
}
