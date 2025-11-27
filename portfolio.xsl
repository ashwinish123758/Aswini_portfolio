<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0"
  xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

  <xsl:template match="/">
    <html>
      <head>
        <title>Certifications</title>
        <meta charset="UTF-8"/>
        <style>
          body { font-family: Arial, sans-serif; background:#0f172a; color:#e5e7eb; }
          h1 { color:#38bdf8; }
          table { border-collapse: collapse; width:60%; }
          th, td { border:1px solid #1f2937; padding:8px; text-align:left; }
          th { background:#020617; }
        </style>
      </head>
      <body>
        <h1>Certifications</h1>
        <table>
          <tr>
            <th>Title</th>
            <th>Platform</th>
            <th>Year</th>
          </tr>
          <xsl:for-each select="certifications/certificate">
            <tr>
              <td><xsl:value-of select="title"/></td>
              <td><xsl:value-of select="platform"/></td>
              <td><xsl:value-of select="year"/></td>
            </tr>
          </xsl:for-each>
        </table>
      </body>
    </html>
  </xsl:template>
</xsl:stylesheet>