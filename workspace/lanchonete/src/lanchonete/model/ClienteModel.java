package lanchonete.model;

import java.math.BigDecimal;

public class ClienteModel {
	private BigDecimal codigoCliente;
	private String nome;
	private String endereco;
	private String telefone;
	private BigDecimal cpf;
	
	public String getNome() {
		return nome;
	}
	public void setNome(String nome) {
		this.nome = nome;
	}
	public String getEndereco() {
		return endereco;
	}
	public void setEndereco(String endereco) {
		this.endereco = endereco;
	}
	public String getTelefone() {
		return telefone;
	}
	public void setTelefone(String telefone) {
		this.telefone = telefone;
	}
	public BigDecimal getCpf() {
		return cpf;
	}
	public void setCpf(BigDecimal cpf) {
		this.cpf = cpf;
	}
	public BigDecimal getCodigoCliente() {
		return codigoCliente;
	}
	public void setCodigoCliente(BigDecimal codigoCliente) {
		this.codigoCliente = codigoCliente;
	}
	
	
}
