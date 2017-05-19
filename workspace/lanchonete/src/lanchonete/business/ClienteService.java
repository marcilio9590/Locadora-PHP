package lanchonete.business;

import java.math.BigDecimal;
import java.util.ArrayList;
import java.util.List;

import lanchonete.DAO.ClienteDao;
import lanchonete.model.ClienteDto;
import lanchonete.view.ClienteView;

public class ClienteService {
	
	public void listarCliente(){
		ClienteDao dao = new ClienteDao();
		try {
			List<ClienteDto> lista = dao.listarClientes();
			if(!lista.isEmpty()){
				ClienteView clienteView = new ClienteView();
				clienteView.listarCliente(lista);
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	
	public void getCliente(BigDecimal codCliente){
		ClienteDao dao = new ClienteDao();
		try {
			List<ClienteDto> lista = new ArrayList<>();
			lista.add(dao.getCliente(codCliente));
			if(!lista.isEmpty()){
				ClienteView clienteView = new ClienteView();
				clienteView.listarCliente(lista);
			}
		} catch (Exception e) {
			e.printStackTrace();
		}
	}
	
}
