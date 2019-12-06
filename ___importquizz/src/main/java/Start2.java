
import java.io.IOException;
import java.sql.Connection;
import java.sql.DriverManager;
import java.sql.SQLException;
import java.sql.Statement;
import java.util.HashMap;
import java.util.Map;
import java.util.UUID;

import org.json.simple.JSONArray;
import org.json.simple.JSONObject;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/**
 *
 * @author lolo
 */
public class Start2 {

    /**
     * @param args the command line arguments
     */
    public static void main(String[] args) throws IOException {

        final String JDBC_DRIVER = "com.mysql.jdbc.Driver";
        final String DB_URL = "jdbc:mysql://localhost/reflexyon_v0?jdbcCompliantTruncation=no";

        //  Database credentials
        final String USER = "root2";
        final String PASS = "root2";

        int i = 0;

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

            /**
             * *****************************************************
             * Traitement
             */
            ImportFicGIFT tmp = new ImportFicGIFT();
            int nb = 0;
            int cptOrder = 0;

            tmp.readFile("quizz.txt");

            //System.out.println(tmp.getFlux()) ;
            Map<String, String> Q = new HashMap<String, String>();
            // On lit la première question du correspond a la creation du Quizz
            Q = tmp.extractQ();
            UUID uuid = UUID.randomUUID();
            String quizzId = uuid.toString().substring(1, 32);

            String sql = "insert into quizz values (";
            sql = sql + "\"" + quizzId + "\",";
            sql = sql + "\"" + Q.get("2") + "\",";
            sql = sql + "\"" + "007\",";
            sql = sql + "\"" + Q.get("3").substring(2) + "\",";
            sql = sql + "\"" + Q.get("4").substring(2) + "\",";
            sql = sql + "\"" + Q.get("1") + "\")";

            stmt.executeUpdate(sql);

            JSONObject obj01 = new JSONObject(); // obj.put("name", "mkyong.com");
            JSONObject obj02 = new JSONObject(); // obj.put("name", "mkyong.com");
            JSONObject obj03 = new JSONObject(); // obj.put("name", "mkyong.com");
            JSONArray list01 = new JSONArray(); //  list.add("msg 1");  obj.put("messages", list);
            JSONArray list02 = new JSONArray(); //  list.add("msg 1");  obj.put("messages", list);

            /**
             * *********************************
             *
             */
            // on lit la question suivante
            Q = tmp.extractQ();
            boolean bFin = false ;
            while (Integer.parseInt(Q.get("0")) > 0) {
                obj01 = new JSONObject(); // obj.put("name", "mkyong.com");
                obj02 = new JSONObject(); // obj.put("name", "mkyong.com");
                obj03 = new JSONObject(); // obj.put("name", "mkyong.com");
                list01 = new JSONArray(); //  list.add("msg 1");  obj.put("messages", list);
                list02 = new JSONArray(); //  list.add("msg 1");  obj.put("messages", list);

                cptOrder = cptOrder + 1;
                String strReponses = "";
                String strCorrectes = "";
                String strTmp;

                // on code la réponse
                for (i = 3; i < Integer.parseInt(Q.get("0")); i++) {
                    strTmp = Q.get(Integer.toString(i));
                    list01.add(strTmp.substring(1));
                    if (strTmp.substring(0, 1).equals("=")) {
                        list02.add(Integer.toString(i));
                    }
                }
                System.out.println(i);
                obj01.put("responses", list01);
                obj01.put("correctResponses", list02);

                uuid = UUID.randomUUID();

                sql = "insert into question values (";
                sql = sql + "'" + uuid.toString().substring(1, 32) + "',";
                sql = sql + "'" + Q.get("2") + "',";
                sql = sql + "'[" + obj01.toJSONString() + "]',";
                sql = sql + "'" + quizzId + "',";
                sql = sql + "'" + Q.get("3") + "',";
                sql = sql + "'" + Integer.toString(cptOrder) + "',";
                sql = sql + "'" + "QCM')";

                System.out.println(sql);

                System.out.println(stmt.execute(sql));
                Q = tmp.extractQ();

            }
            stmt.close();
            conn.close();
        } catch (SQLException se) {
            //Handle errors for JDBC
            se.printStackTrace();
        } catch (Exception e) {
            //Handle errors for Class.forName
            e.printStackTrace();
        } finally {
            //finally block used to close resources
            try {
                if (stmt != null) {
                    stmt.close();
                }
            } catch (SQLException se2) {
            }// nothing we can do
            try {
                if (conn != null) {
                    conn.close();
                }
            } catch (SQLException se) {
                se.printStackTrace();
            }//end finally try
        }//end try

    }
}
